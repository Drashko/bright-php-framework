<?php

namespace App\Repository\Permission;

use App\Entity\PermissionEntity;

interface PermissionRepositoryInterface
{
    public function find($id) : PermissionEntity;
    public function list(array $conditions) : array;
    public function create(PermissionEntity $permissionEntity) : PermissionEntity;
    public function delete(PermissionEntity $permissionEntity, int $id) : bool;
    public function update(PermissionEntity $permissionEntity, int $id) : PermissionEntity;
}