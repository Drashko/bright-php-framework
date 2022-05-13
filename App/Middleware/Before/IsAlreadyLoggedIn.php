<?php
declare(strict_types=1);

namespace App\Middleware\Before;

use App\Service\Auth\AuthenticateService;
use App\Service\Auth\AuthorizedService;
use src\Flash\Flash;
use src\Flash\FlashTypes;
use src\Middleware\BeforeMiddleware;
use src\Utility\Route;

class IsAlreadyLoggedIn extends BeforeMiddleware
{
    protected AuthenticateService $authenticate;

    public function __construct()
    {
        $this->authenticate = new AuthenticateService();
    }

    /**
     * Prevent unauthorized access to the administration panel. Only logged in users with specific
     * privileges can access the admin area.
     *
     * @param Object $middleware
     * @param Closure $next
     * @return void
     */
    public function middleware(object $middleware, \Closure $next)
    {
        if (!$this->authorized->isLoggedIn()) {
            Flash::add("You must be logged in to access this page!", FlashTypes::DANGER);
            Route::redirect('login/index');

        }
        return $next($middleware);

    }
}