<?php

namespace App\Repository\RolePermission;

use App\Entity\RolePermissionEntity;
use PDO;
use src\DataMapper\DataMapperInterface;
use src\QueryBuilder\QueryBuilderInterface;
use src\Utility\Sanitizer;

// SELECT permission.Id ,permission.code,permission.description,
// role_permission.role_id AS roleId,
// role_permission.permission_id AS permissionId,
// permission.name AS permissionName
// FROM permission
// LEFT JOIN role_permission ON permission.Id = role_permission.permission_id AND role_id = 4 ORDER BY code DESC

class RolePermissionRepository implements RolePermissionRepositoryInterface
{

    private DataMapperInterface $dataMapper;

    private QueryBuilderInterface $queryBuilder;

    private RolePermissionEntity $rolePermissionEntity;

    public function __construct(DataMapperInterface $dataMapper, QueryBuilderInterface $queryBuilder, RolePermissionEntity $rolePermissionEntity)
    {
        $this->queryBuilder = $queryBuilder;
        $this->dataMapper = $dataMapper;
        $this->rolePermissionEntity = $rolePermissionEntity;

    }

    /**
     * @param $id
     * @return RolePermissionEntity
     */
    public function find($id): RolePermissionEntity
    {
        $mapper = $this->dataMapper->findOneBy('`role_permission`', 'id' , $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, RolePermissionEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {

        $sql = "SELECT p.id , rp.role_id, rp.permission_id AS permissionId, p.name, p.code, p.description  \n"
            . "FROM `permission` p \n"
            . "LEFT JOIN `role_permission` rp ON (p.id = rp.permission_id AND rp.role_id = ". array_values($conditions)[0] .") \n"
            . "ORDER BY p.code DESC;";
        $stm = $this->dataMapper->raw($sql);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        //pr($result);
        /*$result = $this->queryBuilder
            ->table('permission')
            ->select('permission.Id ,permission.code,permission.description,  role_permission.role_id AS roleId, role_permission.permission_id AS permissionId, permission.name AS permissionName')
            ->join(' LEFT', 'role_permission', ("permission.Id = role_permission.permission_id AND role_id = " . array_values($conditions)[0] . ""))
            ->orderBy('code', 'DESC')
            ->executeQuery();*/


        return $this->queryBuilder->group($result, 'code');
    }

    /**
     * @param int $roleId
     * @param array $permission
     * @return bool
     * @throws \Exception
     */
    public function assign(int $roleId, array $permission): bool
    {
        $permission = Sanitizer::clean($permission);
        if ($permission)
            foreach ($permission as $permValue) {
                $condition = ['role_id' => $roleId, 'permission_id' => $permValue];
                $lookup = $this->dataMapper->findAll('role_permission', $condition);
                $find =  $lookup->fetch();
                if ($find) {
                    continue;
                } else {
                    $rolePermission = $this->rolePermissionEntity
                        ->setRoleId($roleId)
                        ->setPermissionId((int) $permValue)
                        ->setCreatedAt(date('Y-m-d H:i:s'))
                        ->setUpdatedAt(date('Y-m-d H:i:s'));
                    //crate new entity roll
                    $this->create($rolePermission);
                }
            }
        $this->findNotMatchingPermission($roleId, $permission);
        return true;
    }

    /**
     * @param $roleId
     * @param $postPermission
     * @return void
     */
    public function findNotMatchingPermission($roleId, $postPermission): void
    {
        $stm = $this->dataMapper->findAll('role_permission', ['role_id' => $roleId]);
        $rolePermissionList = $stm->fetchAll(PDO::FETCH_ASSOC);
        $rolePermissionFromTable = [];
        foreach($rolePermissionList as $permission){
            $rolePermissionFromTable[] = $permission['permission_id'];
        }
        $removePermissionList = array_diff($rolePermissionFromTable, $postPermission);
        $this->deleteNotMatchingRolePermission($roleId, $removePermissionList);
    }

    /**
     * Delete records
     * @param $roleId
     * @param array $permission
     */
    public function deleteNotMatchingRolePermission( $roleId, array $permission){
        foreach($permission as $perm){
            $condition = ['role_id' => $roleId, 'permission_id' => $perm];
            $lookup =  $this->dataMapper->findAll('role_permission', $condition);
            $find = $lookup->fetch(PDO::FETCH_ASSOC);
            $this->delete($find['Id']);
        }
    }

    /**
     * @param RolePermissionEntity $rolePermissionEntity
     * @return RolePermissionEntity
     */
    public function create(RolePermissionEntity $rolePermissionEntity): RolePermissionEntity
    {
        $mapper = $this->dataMapper->create($rolePermissionEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, RolePermissionEntity::class);
        return $mapper->fetch();
    }

    public function delete($id): bool
    {
        return $this->dataMapper->simpleDelete('role_permission', $id);
    }


}