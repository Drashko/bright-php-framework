<?php

namespace App\Repository\User;

use App\Entity\UserEntity;

interface UserCreateRepositoryInterface
{
  public function create(UserEntity $userEntity) : mixed;
}