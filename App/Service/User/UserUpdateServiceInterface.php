<?php

namespace App\Service\User;

use App\Entity\UserEntity;

interface UserUpdateServiceInterface
{
    public function update(string $id, array $data) : mixed;
}