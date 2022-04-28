<?php

namespace App\Repository\RolePermission;

use App\Entity\RolePermissionEntity;
use App\Entity\UserEntity;
use src\DataMapper\DataMapperInterface;
use src\QueryBuilder\QueryBuilderInterface;

class RolePermissionRepository implements RolePermissionRepositoryInterface
{

    private DataMapperInterface $dataMapper;

    private QueryBuilderInterface $queryBuilder;

    public function __construct(DataMapperInterface $dataMapper, QueryBuilderInterface $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
        $this->dataMapper = $dataMapper;

    }

    /**
     * @param $id
     * @return RolePermissionEntity
     */
    public function find($id): RolePermissionEntity
    {
        $user = $this->dataMapper->findOneBy('`role_permission`', 'id' , $id);
        return $user->fetchAllInto(RolePermissionEntity::class)[0];
    }

    /**
     * @param array $conditions
     * @return array
     */
    /*public function list(array $conditions): array
    {
        //SELECT * FROM `role` AS r LEFT JOIN `role_permission` AS rp ON r.id = rp.role_id LEFT JOIN `permission` AS p ON rp.permission_id = p.Id;
        $result = $this->queryBuilder
            ->table('role AS r')
            ->select('r.Id AS roleId,r.name,rp.permission_id AS rolePermissionId, r.name AS roleName,p.id AS permissionId ,p.code, p.description, p.name AS permissionName')
            ->join(' LEFT ', 'role_permission As rp', 'r.id = rp.role_id')
            ->join(' RIGHT ' , 'permission AS p' , 'rp.permission_id = p.id')
            //->where();
            //->groupBy('roleName')
            ->orderBy('r.Id IS NULL')
            ->executeQuery();
        //stdClass to array
        $grouped = json_decode(json_encode($result->fetchAllAssoc()), true);
        return $this->queryBuilder->group( $grouped, 'name');
    }*/
    public function list(array $conditions): array
    {
        //$userList = $this->dataMapper->findAll('`role_permission`', array_filter($conditions));
        //return $userList->fetchAllInto(RolePermissionEntity::class);
        $result = $this->queryBuilder
            ->table('permission')
            ->select('permission.Id ,permission.code,permission.description,  role_permission.role_id AS roleId, role_permission.permission_id AS permissionId, permission.name AS permissionName')
            ->join(' LEFT', 'role_permission', ("permission.Id = role_permission.permission_id AND role_id = " . array_values($conditions)[0] . ""))
            //->groupBy('roleName')
            //->orderBy('r.Id IS NULL')
            ->executeQuery();
        return $result->fetchAllAssoc();
    }


    /**
     * @return mixed
     */
    public function assign(): mixed
    {
        // TODO: Implement assign() method.
    }
}