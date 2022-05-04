<?php

namespace App\Repository\Permission;

use App\Entity\PermissionEntity;
use App\Entity\RoleEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class PermissionRepository implements PermissionRepositoryInterface
{

    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param $id
     * @return PermissionEntity
     */
    public function find($id): PermissionEntity
    {
        $mapper = $this->dataMapper->findOneBy('`permission`', 'Id' , $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, PermissionEntity::class);
        return  $mapper->fetch();
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {
        $mapper = $this->dataMapper->findAll('`permission`', array_filter($conditions));
        return $this->dataMapper->fetchAllInto($mapper, PermissionEntity::class);
    }

    /**
     * @param PermissionEntity $permissionEntity
     * @return PermissionEntity
     */
    public function create(PermissionEntity $permissionEntity): PermissionEntity
    {
        $mapper = $this->dataMapper->create($permissionEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, PermissionEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param PermissionEntity $permissionEntity
     * @param int $id
     * @return bool
     */
    public function delete(PermissionEntity $permissionEntity, int $id): bool
    {
        return $this->dataMapper->delete($permissionEntity, $id);
    }

    /**
     * @param PermissionEntity $permissionEntity
     * @param int $id
     * @return PermissionEntity
     */
    public function update(PermissionEntity $permissionEntity, int $id): PermissionEntity
    {
        $mapper = $this->dataMapper->update($permissionEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, PermissionEntity::class);
        return $mapper->fetch();
    }
}