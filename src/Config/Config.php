<?php

namespace src\Config;

class Config{

    protected static array $data;
    protected static $default;


    /**
     * @param $file
     * @param null $key
     * @param null $default
     * @return mixed
     */

    public static function get($file, $key = null, $default = null): mixed
    {
        self::$default = $default;
        //$this->data = require dirname(__DIR__) . DIRECTORY_SEPARATOR .'Config/'.DIRECTORY_SEPARATOR. $file . ".php";
        self::$data = require ROOT_PATH . DIRECTORY_SEPARATOR .'App/Config/'.DIRECTORY_SEPARATOR. $file . ".php";
        $segments = explode('.', $key);
        $data = self::$data;
        foreach($segments as $segment){
            if(isset($data[$segment])){
                $data = $data[$segment];
            }else{
                $data = self::$default;
                break;
            }
        }
        if(isset($key)){
            return $data;
        }else {
            return (array) self::$data;
        }
    }
}