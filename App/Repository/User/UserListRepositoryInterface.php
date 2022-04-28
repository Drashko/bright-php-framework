<?php

namespace App\Repository\User;

interface UserListRepositoryInterface
{
  public function list(array $conditions) : array;
}