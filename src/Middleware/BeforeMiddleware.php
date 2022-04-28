<?php

namespace src\Middleware;

use Closure;

class BeforeMiddleware implements MiddlewareInterface
{

    /**
     * @param Object $middleware
     * @param Closure $next
     */
    public function middleware(object $middleware, Closure $next)
    {
        return $next($middleware);
    }
}