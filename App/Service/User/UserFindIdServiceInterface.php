<?php

namespace App\Service\User;

use App\Entity\UserEntity;

interface UserFindIdServiceInterface
{
   public function find(string $id) : UserEntity;
}