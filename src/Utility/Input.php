<?php

namespace src\Utility;

use JetBrains\PhpStorm\Pure;

class Input
{
    /**
     * checks weather or not  is $_POST request
     * @return bool
     */
    #[Pure] public function isPost(): bool
    {
        return $this->getRequestMethod() === 'POST';
    }

    /**
     * checks weather or not  is PUT request
     * @return bool
     */
    #[Pure] public function isPut(): bool
    {
        return $this->getRequestMethod() === 'PUT';
    }

    /**
     * checks weather or not  is $_GET request
     * @return bool
     */
    #[Pure] public function isGet(): bool
    {
        return $this->getRequestMethod() === 'GET';
    }

    /**
     * retuns the $_SERVER['REQUEST_METHOD']
     * @return string
     */
    public function getRequestMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @param false $input
     * @return array|string
     */
    #[Pure] public function get($input=false): array|string
    {
        if(!$input){
            // return entire request array and sanitize it
            $data = [];
            foreach($_REQUEST as $field => $value){
                $data[$field] = trim(Form::sanitize($value));
            }
            return $data;
        }

        return (array_key_exists($input,$_REQUEST)) ? trim(Form::sanitize($_REQUEST[$input])) : '';
    }

    /**
     * @return bool
     */
    public function csrfCheck(): bool
    {
        if(!Form::checkToken($this->get('csrf_token'))) Router::redirect('restricted/badToken');
        return true;
    }
}