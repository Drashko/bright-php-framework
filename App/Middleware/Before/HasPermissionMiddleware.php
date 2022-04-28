<?php

namespace App\Middleware\Before;

use src\Middleware\BeforeMiddleware;
use Closure;
class HasPermissionMiddleware extends BeforeMiddleware
{
    /**
     * Prevent unauthorized access to the administration panel. Only logged in users with specific
     * privileges can access the admin area.
     *
     * @param Object $middleware
     * @param Closure $next
     * @return void
     */
    public function middleware(object $middleware, Closure $next)
    {
        //check if user is logged in
        //check for session user id
        //if not redirect to logged in
        /*if (!file_exists(APP_ROOT . '/.env.lip')) {
            $middleware->error?->addError(['missing_env' => 'Error locating the system .env file.'], $middleware)->dispatchError();
        }*/
        //pr('HasPermissionMiddleware');
        return $next($middleware);

    }
}