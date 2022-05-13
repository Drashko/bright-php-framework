<?php

namespace App\Service\Auth;

interface AuthorizedServiceInterface
{
    public function isLoggedInSession() : bool;
    public function isLoggedInCookie() : bool;
    public function getRole() : bool;
    public function getPermission() : bool;
    public function hasPermission() : bool;
    public function loggedUser() : bool;
}