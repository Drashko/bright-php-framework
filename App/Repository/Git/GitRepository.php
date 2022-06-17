<?php
declare(strict_types=1);

namespace App\Repository\Git;

use App\Entity\GitEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class GitRepository implements GitRepositoryInterface
{

    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }


    /**
     * @param $id
     * @return GitEntity
     */
    public function find($id): GitEntity
    {
        $mapper = $this->dataMapper->findById('`git`', $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, GitEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {
        $mapper = $this->dataMapper->findAll('`git`', $conditions);
        return $this->dataMapper->fetchAllInto($mapper,GitEntity::class);
    }

    /**
     * @param GitEntity $gitEntity
     * @return GitEntity
     */
    public function create(GitEntity $gitEntity): GitEntity
    {
        $mapper = $this->dataMapper->create($gitEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, GitEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param GitEntity $gitEntity
     * @param int $id
     * @return bool
     */
    public function delete(GitEntity $gitEntity, int $id): bool
    {
        return $this->dataMapper->delete($gitEntity, $id);
    }

    /**
     * @param GitEntity $gitEntity
     * @param int $id
     * @return GitEntity
     */
    public function update(GitEntity $gitEntity, int $id): GitEntity
    {
        $mapper = $this->dataMapper->update($gitEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, GitEntity::class);
        return $mapper->fetch();
    }
}