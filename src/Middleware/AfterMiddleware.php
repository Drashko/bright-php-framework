<?php

namespace src\Middleware;

use Closure;

class AfterMiddleware implements MiddlewareInterface
{

    /**
     * @param Object $middleware
     * @param Closure $next
     * @return mixed
     */
    public function middleware(object $middleware, Closure $next): mixed
    {
        return $next($middleware);
    }
}