<?php

namespace App\Repository\User;

use App\Entity\UserEntity;

interface UserEmailRepositoryInterface
{
   public function find( string $email) : mixed;
}