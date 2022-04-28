<?php

namespace src\Middleware;

use Closure;

interface MiddlewareInterface
{
    public function middleware(Object $middleware, Closure $next);
}