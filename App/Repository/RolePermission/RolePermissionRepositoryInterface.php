<?php

namespace App\Repository\RolePermission;

use App\Entity\RolePermissionEntity;

interface RolePermissionRepositoryInterface
{
    public function find($id) : RolePermissionEntity;
    public function list(array $conditions) : array;
    public function assign() : mixed;

}