<?php

namespace App\Repository\RolePermission;

use App\Entity\RolePermissionEntity;

interface RolePermissionRepositoryInterface
{
    public function find($id) : RolePermissionEntity;
    public function list(array $conditions) : array;
    public function create(RolePermissionEntity $rolePermissionEntity) : RolePermissionEntity;
    public function assign(int $roleId , array $permission) : mixed;

}