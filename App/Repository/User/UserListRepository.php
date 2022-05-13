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

    private int $count;

    /**
     * @param DataMapperInterface $dataMapper
     */
    public function __construct(DataMapperInterface $dataMapper, Paginator $paginator)
    {
           $this->dataMapper = $dataMapper;
           $this->paginator = $paginator;
    }

    /**
     * @param array $conditions
     * @return array|null
     */
    public function list(array $conditions): ?array
    {
        //set pagination
        $conditions['page'] = $conditions['page'] ?? 1;
        $conditions['limit'] = 30;
        //set pagination data
        $this->paginator->setTotalRecords($this->findAll());
        $this->paginator->setRecordsPerPage($conditions['limit']);
        $this->paginator->setPage($conditions['page']);
        $conditions['offset'] = $this->paginator->getOffset();
        $where = [];
        $offsetLimit = '';
        if(!empty($conditions)){
            foreach ($conditions as $key => $value) {
                if(str_contains($key, 'page') OR (str_contains($key, 'limit')) OR (str_contains($key, 'offset'))) continue;
                if(!empty($key)){
                    $where[] = "`{$key}`" . "="  . " :$key";
                }
            }
            if (!empty($where)) {
                $where = ' WHERE ' . implode(' AND ', $where);
            }else{
                $where = ' WHERE  1';
            }
            if(isset($conditions['offset']) && isset($conditions['limit'])){
                $offsetLimit  = 'LIMIT ' . $conditions['offset'] . ',' . $conditions['limit'];
            }
            $sql = "SELECT  * FROM `users` {$where} {$offsetLimit}";
            //pr($sql);
            $stm = $this->dataMapper->raw($sql);
                foreach($conditions as $key => $value){
                    if(str_contains($key, 'page') OR (str_contains($key, 'limit')) OR (str_contains($key, 'offset'))) continue;
                    $stm->bindValue($key , $value ,  $this->dataMapper->bind($value));
                }
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS, UserEntity::class);
            $this->count = count($result);
            return $result;

        }
        return null;
    }

    /**
     * @return int
     */
    public function findAll(): int
    {
        $mapper = $this->dataMapper->findAll('users');
        return count($mapper->fetchAll());

    }

    public function getPaginatorTotalPages(): int
    {
        return $this->paginator->getTotalPages();
    }

    /**
     * get numbure of filterd result
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}