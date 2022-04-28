<?php

namespace App\Service\Auth;

interface AuthServiceInterface
{
    public function isLoggedIn() : bool;
    public function logOut() : bool;
    public function getRole() : bool;
    public function getPermission() : bool;
    public function hasPermission() : bool;
    public function loggedUser() : bool;

}