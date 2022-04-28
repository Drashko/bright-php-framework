<?php

namespace App\Repository\Permission;

use App\Entity\PermissionEntity;
use App\Entity\RoleEntity;
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
        $user = $this->dataMapper->findOneBy('`permission`', 'Id' , $id);
        return $user->fetchAllInto(PermissionEntity::class)[0];
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {
        $userList = $this->dataMapper->findAll('`permission`', array_filter($conditions));
        return $userList->fetchAllInto(PermissionEntity::class);
    }

    /**
     * @param PermissionEntity $permissionEntity
     * @return PermissionEntity
     */
    public function create(PermissionEntity $permissionEntity): PermissionEntity
    {
        $result = $this->dataMapper->create($permissionEntity);
        return $result->fetchAllInto(PermissionEntity::class)[0];
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
        $result = $this->dataMapper->update($permissionEntity, $id);
        return $result->fetchAllInto(PermissionEntity::class)[0];
    }
}