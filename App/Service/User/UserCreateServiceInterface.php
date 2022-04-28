<?php

namespace App\Service\User;

use App\Entity\UserEntity;

interface UserCreateServiceInterface
{
   public function create(array $data) : array | null;
}