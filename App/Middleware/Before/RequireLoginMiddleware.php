<?php

declare(strict_types=1);

namespace App\Middleware\Before;

use App\Service\Auth\AuthorizedService;
use src\Flash\Flash;
use src\Flash\FlashTypes;
use src\Middleware\BeforeMiddleware;

use Closure;
use src\Utility\Route;

class RequireLoginMiddleware extends BeforeMiddleware
{
    protected AuthorizedService $authorized;

    public function __construct()
    {
        $this->authorized = new AuthorizedService();

    }

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
        if (!$this->authorized->isLoggedInSession() AND !$this->authorized->isLoggedInCookie()) {
            Flash::add("You must be logged in to access this page!", FlashTypes::DANGER);
            Route::redirect('login/index');
        }
        return $next($middleware);

    }
}