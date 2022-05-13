<?php

namespace src\Base;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use src\Exception\NotFoundException;
use src\Factory\RequestFactory;
use src\Factory\TemplateFactory;
use src\Middleware\Middleware;
use src\Template\Template;
use src\Utility\Request;

class BaseController
{


        public ?string $layout = null;

        protected Template $template;
        protected Request $request;

        /** @var array */
        protected array $callBeforeMiddlewares = [];
        /** @var array */
        protected array $callAfterMiddlewares = [];


        public function __construct(){
           //$this->template = new Template();
           $this->template = TemplateFactory::make();
           $this->request = RequestFactory::make();
        }

    /**
     * @param string $template
     * @param array $data
     * @param string $layout
     * @return void
     * @throws NotFoundException
     */
    public function render(string $template, array $data = [], string $layout = ''): void
    {
        $this->layout = !empty($layout) ? $layout : $this->layout;
        $this->template->render($template, $data, $this->layout);
    }

    /**
     * load Ajax template with data
     * @param string $template
     * @param array $data
     */
    #[NoReturn] public function renderAjax(string $template, array $data = []){
       $this->template->renderAjax($template,$data);
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param $name
     * @param $arguments
     * @throws Exception
     * @return void
     */
    public function __call($name, $arguments) : void
    {
        $method = $name . 'Action';
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $arguments);
                $this->after();
            }
        } else {
            throw new Exception('Method ' . $method . ' does not exist in ' . get_class($this));
        }
    }
    /**
     * Returns an array of middlewares for the current object which will
     * execute before the action is called. Middlewares are also resolved
     * !!! via the container object. So you can also type hint any dependency
     * you need within your middleware constructor. Note constructor arguments
     * cannot be resolved only other objects
     *
     * @return array
     */
    protected function callBeforeMiddlewares(): array
    {
        return $this->callBeforeMiddlewares;
    }

    /**
     * Returns an array of middlewares for the current object which will
     * execute before the action is called. Middlewares are also resolved
     * via the container object. So you can also type hint any dependency
     * you need within your middleware constructor. Note constructor arguments
     * cannot be resolved only other objects
     *
     * @return array
     */
    protected function callAfterMiddlewares(): array
    {
        return $this->callAfterMiddlewares;
    }

    /**
     * Before method. Call before controller action method
     * @return void
     */
    protected function before()
    {
        $object = new self();
        (new Middleware())->middlewares($this->callBeforeMiddlewares())
            ->middleware($object, function ($object) {
                return $object;
            });
    }

    /**
     * After method. Call after controller action method
     *
     * @return void
     */
    protected function after()
    {
        $object = new self();
        (new Middleware())->middlewares($this->callAfterMiddlewares())
            ->middleware($object, function ($object) {
                return $object;
            });
    }


    /**
     * @param string|null $http
     */
    #[NoReturn] public function redirect(string $http = null)
    {
        if ($http) {
            $redirect = INDEX_URL . $http;
        } else {
            $redirect = $_SERVER['HTTP_REFERER'] ?? "/";
        }
        header("location:" . $redirect, true, 303);
        exit;
    }



    /**
     * Check if it is Ajax call
     * HTTP_X_REQUESTED_WITH must be set in js header type
     * @return bool
     */
    public function isAjax(): bool{
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * used to for a json response
     * @method jsonResponse
     * @param array $resp associative array that gets json encoded
     */
    #[NoReturn] public function jsonResponse(array $resp){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code(200);
        echo json_encode($resp);
        exit;
    }

}