<?php

namespace App\Service\Auth;

use src\Factory\SessionFactory;

class AuthorizedService implements AuthorizedServiceInterface
{
    public function __construct()
    {
        $this->session = SessionFactory::make();
    }

    /**
     * @return bool
     */
    public function isLoggedInSession(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function isLoggedInCookie(): bool
    {
        return isset($_COOKIE['remember_me']);
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
        // if(isset(session->user->id))
        //return findById()
        //else{
        //
        //}

    }
}