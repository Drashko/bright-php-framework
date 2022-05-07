<?php

namespace App\Service\User;

interface UserLoginServiceInterface
{
    /**
     * @param array $data
     * @return array|null
     */
   public function loginValidate(array $data) : ?array;
}