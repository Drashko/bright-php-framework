<?php

namespace src\Router;

interface RouterInterface
{
    /**
     * Adds route to the routing table
     * @param string $route
     * @param array $params
     */
    public function add(string $route, array $params = []) : void;

    /**
     * Dispatch route and creates controller object with default method
     * @param string $url
     */
    public function dispatch(string $url) : void;
}