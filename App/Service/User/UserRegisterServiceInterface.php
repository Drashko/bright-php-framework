<?php

namespace App\Service\User;

interface UserRegisterServiceInterface
{
    public function register(array $data) : array | null;
}