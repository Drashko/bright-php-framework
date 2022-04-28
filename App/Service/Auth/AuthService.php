<?php

namespace App\Service\Auth;

use src\Factory\SessionFactory;

class AuthService implements AuthServiceInterface
{

    //get session class
    //get user Repository ?
    //get DataMapper if needs
    //get another service if needed
    //consider AuthFactory
    //get Role and Permissions Repositories

    protected $session;

    public function __construct()
    {
         $this->session = SessionFactory::make();
    }

    /**
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return $this->session->has('userId');
    }

    /**
     * @return bool
     */
    public function logOut(): bool
    {
        // TODO: Implement logOut() method.
    }

    /**
     * @return bool
     */
    public function getRole(): bool
    {
        // TODO: Implement getRole() method.
    }

    /**
     * @return bool
     */
    public function getPermission(): bool
    {
        // TODO: Implement getPermission() method.
    }

    /**
     * @return bool
     */
    public function hasPermission(): bool
    {
        // TODO: Implement hasPermission() method.
    }

    /**
     * @return bool
     */
    public function loggedUser(): bool
    {
        // TODO: Implement loggedUser() method.
    }
}