<?php

namespace App\Repository\User;

use App\Entity\UserEntity;

interface UserDeleteRepositoryInterface
{
   public function delete(UserEntity $userEntity, int $id) : bool;
}