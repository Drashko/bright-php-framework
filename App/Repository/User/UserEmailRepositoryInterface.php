<?php

namespace App\Repository\User;

interface UserEmailRepositoryInterface
{
   public function find( string $email) : array;
}