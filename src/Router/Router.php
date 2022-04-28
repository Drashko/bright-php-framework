<?php
declare(strict_types=1);

namespace src\Router;


use DI\Container;
use Exception;

class Router implements RouterInterface
{
    /**
     * @var array
     */
    protected array $routes = [];
    /**
     * @var array
     */
    protected array $params = [];
    /**
     * @var string
     */
    protected string $controllerSuffix = "Controller";

    /** @var string
     * default controller namespace
     */
    protected string $namespace = 'App\Controller\\';

    /**
     * @param Container $container
     * @throws Exception
     */
    public function __construct(private Container $container){
        $this->container = $this->getDependencies();
    }
    /**
     * @param string $route
     * @param array $params
     */
    public function add(string $route, array $params = []): void
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);
        // Convert variables e.g. {controller}
         $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        //echo $route;
        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;


    }

    /**
     * @param string $url
     * @throws \Exception
     */
    public function dispatch(string $url): void
    {
        //remove query params before dispatching the  route
        $url = $this->removeQueryStringVariables($url);
        if($this->match($url)){
            $controllerString = $this->params['controller'] . $this->controllerSuffix;
            $controllerString = $this->transformUpperCamelCase($controllerString);
            $controllerString = $this->getNamespace() . $controllerString;
            if(class_exists($controllerString)){
                //pass params to Controller constructor
                //$controllerObject = new $controllerString($this->params);
                $controllerObject = $this->container->get($controllerString);
                $action = $this->params['action'];
                $action = $this->transformCamelCase($action);
                //remove unnecessary params
                $params = [];
                if(array_key_exists('id', $this->params)) {
                    $params['id'] = $this->params['id'];
                }
                //if the method is not private
                if (preg_match('/action$/i', $action) == 0){
                //if(is_callable([$controllerObject, $action])){
                    //$controllerObject->$action();
                    call_user_func_array([$controllerObject ,$action], $params);
                }else{
                    throw new \Exception('Method not found');
                }
            }else{
                throw new \Exception('Class not found');
            }
        }else{
            throw new \Exception('Page not found 404');
        }
    }
    /**
     * @param string $string
     * @return array|string
     */
    public function transformUpperCamelCase(string $string): array|string
    {
        return str_replace( ' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * @param string $string
     * @return string
     */
    public function transformCamelCase(string $string ): string
    {
        return lcfirst($this->transformUpperCamelCase($string));
    }

    /**
     * @param string $url
     * @return bool
     */
    public function match(string $url) : bool{
        foreach($this->routes as $route => $params){
            if(preg_match($route, $url , $matches)){
                foreach($matches as $key => $match){
                    if(is_string($key)){
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getNamespace() : string{
       if(array_key_exists('namespace', $this->params)){
            $this->namespace .= $this->params['namespace'] . '\\';
       }
       return $this->namespace;
    }
    /**
     * @param string $url The full URL
     * @return string The URL with the query string variables removed
    */
    protected function removeQueryStringVariables(string $url): string
    {
        //echo $url;
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (!str_contains($parts[0], '=')) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return rtrim($url, '/');
    }


    /**
     * @return array
     */
    public function getRoutes (): array
    {
        return $this->routes;
    }

    /**
     * @return Container
     * @throws Exception
     */
    public function getDependencies(): \DI\Container
    {
        $container = new \DI\ContainerBuilder();
        $container->useAutowiring(true);
        $container->useAnnotations(false);
        $container->addDefinitions(require ROOT_PATH . '/App/Config/dependencies.php');
        return $container->build();
    }
}