<?php

namespace App\Service\User;

interface UserLoginServiceInterface
{
    /**
     * @param array $data
     * @return array|null
     */
   public function login(array $data) : ?array;
}