<?php

namespace App\Repository\Role;

use App\Entity\RoleEntity;
use App\Entity\UserEntity;

interface RoleRepositoryInterface
{
    public function find($id) : RoleEntity;
    public function list(array $conditions) : array;
    public function create(RoleEntity $roleEntity) : RoleEntity;
    public function delete(RoleEntity $roleEntity, int $id) : bool;
    public function update(RoleEntity $roleEntity, int $id) : RoleEntity;
}