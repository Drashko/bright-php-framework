<?php

namespace App\Service\Auth;

use App\Entity\UserEntity;

interface AuthenticateServiceInterface
{
    public function authenticate(string $email, string $password) : object | bool;
    public function logIn(UserEntity $userEntity , bool $remember_me = false) : void;
    public function logOut() : bool;
    public function register(array $data) : object;
    public function getLoggedInUser() : bool | UserEntity;

}