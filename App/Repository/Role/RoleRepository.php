<?php

namespace App\Repository\Role;

use App\Entity\RoleEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class RoleRepository implements RoleRepositoryInterface
{



    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }



    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {
        $mapper = $this->dataMapper->findAll('`role`', $conditions);
        return $this->dataMapper->fetchAllInto($mapper,RoleEntity::class);
    }

    /**
     * @param RoleEntity $roleEntity
     * @return RoleEntity
     */
    public function create(RoleEntity $roleEntity): RoleEntity
    {
        $mapper = $this->dataMapper->create($roleEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, RoleEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param RoleEntity $roleEntity
     * @param int $id
     * @return bool
     */
    public function delete(RoleEntity $roleEntity, int $id): bool
    {
        return $this->dataMapper->delete($roleEntity, $id);
    }

    /**
     * @param RoleEntity $roleEntity
     * @param int $id
     * @return RoleEntity
     */
    public function update(RoleEntity $roleEntity, int $id): RoleEntity
    {
        $mapper = $this->dataMapper->update($roleEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, RoleEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param $id
     * @return RoleEntity
     */
    public function find($id): RoleEntity
    {
        $mapper = $this->dataMapper->findById('`role`', $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, RoleEntity::class);
        return $mapper->fetch();
    }
}
