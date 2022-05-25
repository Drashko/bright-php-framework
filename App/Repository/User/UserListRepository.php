<?php

namespace App\Repository\User;


use App\Entity\UserEntity;
use PDO;
use src\DataMapper\DataMapperInterface;
use src\Utility\Paginator;

class UserListRepository implements UserListRepositoryInterface
{
    /**
     * @var DataMapperInterface
     */
    private DataMapperInterface $dataMapper;

    /**
     * @var Paginator
     */
    private Paginator $paginator;

    private array $conditions;

    private ?int $count = null;

    /**
     * @param DataMapperInterface $dataMapper
     */
    public function __construct(DataMapperInterface $dataMapper, Paginator $paginator)
    {
           $this->dataMapper = $dataMapper;
           $this->paginator = $paginator;
    }

    /**
     * @param $conditions
     * @return array|null
     */
    public function list($conditions): ?array
    {
            //set defaults
            $conditions['page'] = $conditions['page'] ?? 1;
            $conditions['limit'] = 30;
            //set pagination
            $this->setPaginator($conditions['page'], $conditions['limit'], $conditions);
            unset($conditions['page']);
            unset($conditions['limit']);
            $stm = $this->dataMapper->findAll('users', $conditions, 30, (int) $this->paginator->getOffset());
            return $stm->fetchAll(PDO::FETCH_CLASS, UserEntity::class);

    }
    /**
     * @param int $page
     * @param $limit
     * @param array $conditions
     */
    public function setPaginator(int $page, $limit, array $conditions = []){
            $this->paginator->setTotalRecords($this->countAll($conditions));
            $this->paginator->setPage($page);
            $this->paginator->setRecordsPerPage($limit);
    }

    /**
     * @return int
     */
    public function countAll(array $conditions): int
    {
        unset($conditions['limit']);
        unset($conditions['page']);
        $mapper = $this->dataMapper->findAll('users', array_filter($conditions));
        return count($mapper->fetchAll());

    }
    /**
     * @return int|null
     */
    public function getPaginatorTotalPages(): int | null
    {
        return $this->paginator->getTotalPages();
    }

}