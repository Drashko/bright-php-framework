<?php

namespace src\Template;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use src\Exception\NotFoundException;
use src\Factory\SessionFactory;
use src\Utility\Globals;

class Template implements TemplateInterface
{
   /* private string $outBuffer;
    public ?string $head = null;
    public ?string $body = null;*/

    private mixed $_content = [];
    private mixed $_currentContent;
    private mixed $_buffer;
    private string  $layout = 'front';
    private array $userList;

    /**
     * @param string $template
     * @param array $data
     * @param string $layout
     * @throws NotFoundException
     */
    public function render(string $template, array $data = [] , $layout = ''): void
    {
        extract($data);
        $template = TEMPLATE_PATH . $template . '.php';
        //pr($template);
        $this->layout   = !empty($layout) ? TEMPLATE_PATH . "/Layout/" . $layout .'.php' : TEMPLATE_PATH . "/Layout/" . $this->layout .'.php';
        if(file_exists($template)){
            include($template);
            include($this->layout);
        }else{
            throw new NotFoundException('Template not found!');
        }
    }




    /**
     * @param string $template
     * @param array $data
     */
    /*#[NoReturn] public function renderAjax(string $template, array $data = []){
        extract($data);

        $template = TEMPLATE_PATH . $template . '.php';

        if(file_exists($template)) {
            include $template;
        }
        die;
    }*/

    /*/**
     * @param $type
     */
   /* public function start($type){
        $this->outBuffer = $type;
        ob_start();
    }*/
    /**
     * @throws Exception
     */
    /*public function end(){
        if($this->outBuffer == 'head'){
            $this->head = ob_get_clean();
        }elseif($this->outBuffer == 'body'){
            $this->body = ob_get_clean();
        }
        else{
            throw new \RuntimeException('First you must start the function start()!');
        }
    }*/

    /**
     * @param $type
     * @return string|bool|null
     * @throws Exception
     */
   /* public function content($type): string|bool|null
    {
        if($type == 'head'){
            return $this->head;
        }elseif($type == 'body'){
            return $this->body;
        }
        return false;
    }*/
    /**
     * @param $layout
     * @return bool|string|null
     */
    public function setLayout($layout): bool|string|null
    {
        $this->_layout = $layout;
    }
    /**
     * @param $key
     * @throws Exception
     */
    public function start($key)
    {
        if(empty($key)) {
            throw new Exception("Your start method requires a valid key.");
        }
        $this->_buffer = $key;
        ob_start();
    }

    /**
     * @throws Exception
     */
    public function end() {
        if(empty($this->_buffer)) {
            throw new Exception("You must first run the start method.");
        }
        $this->_content[$this->_buffer] = ob_get_clean();
        $this->_buffer = null;
    }

    /**
     * @param $key
     */
    public function content($key) {
        if(array_key_exists($key, $this->_content)) {
            echo $this->_content[$key];
        } else {
            echo '';
        }
    }

    /**
     * @param $url
     * @return string|null
     */
    public function url($url): ?string
    {
        return isset($url) ? INDEX_URL . $url : null;
    }

    /**
     * @param $param
     * @return mixed|string|void
     */
    public function active($param){
        $url = $_SERVER['QUERY_STRING'];
        //get the params and make an array from string
        if(strstr($url, '/')){
            $list = explode("/", $url);
            $list = array_reverse($list);
            $controller = $list[2] ?? '';
            $action = $list[2] ?? '';
            $Id = $list[3] ?? '';
        }else{
            $controller = $url;
        }
        if($param == 'controller'){
            return $controller;
        }
        //pr($param);
    }

    /**
     * Add flash messages to the template
     * @return void|null
     */
    public function flash(){
        $session = SessionFactory::make();
        return $session->get('flash_message');
    }

    /**
     * inserts a partial into another partial
     * @method insert
     * @param  string $path path to view example register/register
     */
    public function insert($path){
        include TEMPLATE_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $path . '.php';
    }

    /**
     * inserts a partial into a view
     * @method partial
     * @param string $group   view sub directory
     * @param string $partial partial name
     */
    public function partial(string $group, string $partial){
        include TEMPLATE_PATH . DIRECTORY_SEPARATOR .  $group . DIRECTORY_SEPARATOR . 'Partials' . DIRECTORY_SEPARATOR . $partial . '.php';
    }





}