<?php

namespace App\Repository\Role;

use App\Entity\RoleEntity;
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
        $userList = $this->dataMapper->findAll('`role`', array_filter($conditions));
        return $userList->fetchAllInto(RoleEntity::class);
    }

    /**
     * @param RoleEntity $roleEntity
     * @return RoleEntity
     */
    public function create(RoleEntity $roleEntity): RoleEntity
    {
        $result = $this->dataMapper->create($roleEntity);
        return $result->fetchAllInto(RoleEntity::class)[0];
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
        $result = $this->dataMapper->update($roleEntity, $id);
        return $result->fetchAllInto(RoleEntity::class)[0];
    }

    /**
     * @param $id
     * @return RoleEntity
     */
    public function find($id): RoleEntity
    {
        $user = $this->dataMapper->findOneBy('`role`', 'id' , $id);
        return $user->fetchAllInto(RoleEntity::class)[0];
    }
}
