<?php

namespace src\Config;

class Config{

    protected array $data;
    protected $default;


    /**
     * @param $file
     * @param null $key
     * @param null $default
     * @return mixed
     */

    public function get($file, $key = null, $default = null): mixed
    {
        $this->default = $default;
        //$this->data = require dirname(__DIR__) . DIRECTORY_SEPARATOR .'Config/'.DIRECTORY_SEPARATOR. $file . ".php";
        $this->data = require ROOT_PATH . DIRECTORY_SEPARATOR .'App/Config/'.DIRECTORY_SEPARATOR. $file . ".php";
        $segments = explode('.', $key);
        $data = $this->data;
        foreach($segments as $segment){
            if(isset($data[$segment])){
                $data = $data[$segment];
            }else{
                $data = $this->default;
                break;
            }
        }
        if(isset($key)){
            return $data;
        }else {
            return (array) $this->data;
        }
    }
}