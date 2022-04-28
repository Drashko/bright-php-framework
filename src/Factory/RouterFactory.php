<?php

namespace src\Factory;

use DI\Container;
use src\Base\Exception\BaseNoValueException;
use src\Base\Exception\BaseUnexpectedValueException;
use src\Router\RouterInterface;

class RouterFactory
{
    /** @var RouterInterface */
    protected RouterInterface $router;

    /** @var string  */
    protected string $dispatchedUrl;

    /** @var array */
    protected array $routes;

    /**
     * @param string $dispatchedUrl
     * @param array $routes - from routes.php config file
     * @throws BaseNoValueException
     */
    public function __construct(string $dispatchedUrl, array $routes)
    {
        if (empty($routes)) {
            throw new BaseNoValueException('There are one or more empty arguments. Please ensure your <code>routes.php</code> has your defined routes and your passing the correct $_SERVER variable ie "QUERY_STRING".');
        }
        $this->dispatchedUrl = $dispatchedUrl;
        $this->routes = $routes;
    }

    /**
     * Instantiate the router object and checks whether the object
     * implements the correct interface else throw an exception.
     *
     * @param string $routerString
     * @return self
     * @throws BaseUnexpectedValueException
     */
    public function create(string $routerString) : self
    {
        $this->router = new $routerString(new Container());
        if (!$this->router instanceof RouterInterface) {
            throw new BaseUnexpectedValueException($routerString . ' is not a valid Router object');
        }
        return $this;

    }

    /**
     * @return bool
     */
    public function buildRoutes(): bool
    {
        if (is_array($this->routes) && !empty($this->routes)) {
            //$args = [];
            foreach ($this->routes as $key => $route) {
                if (isset($route['namespace']) && $route['namespace'] !='') {
                    $args = ['namespace' => $route['namespace']];
                } elseif(isset($route['controller']) && $route['controller'] !='') {
                    $args = ['controller' => $route['controller'], 'action' => $route['action']];
                }
                if (isset($key)) {
                    //print_r($args);
                    $this->router->add($key, $route);
                }
            }
            $this->router->dispatch($this->dispatchedUrl);
        }
        return false;

    }
}