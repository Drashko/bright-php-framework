<?php

namespace App\Repository\User;

use App\Entity\UserEntity;

interface UserUpdateRepositoryInterface
{
    public function update(UserEntity $userEntity, string $id) : UserEntity;
}