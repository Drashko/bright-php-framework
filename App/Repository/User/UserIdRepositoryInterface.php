<?php

namespace App\Repository\User;

use App\Entity\UserEntity;

interface  UserIdRepositoryInterface
{
    public function find($id) : UserEntity;
}