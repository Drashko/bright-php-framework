<?php

namespace src\Exception;

use src\Config\Config;
use Throwable;
use src\Helper\AppHelper;

class ExceptionHandler
{

    /**
     * @param Throwable $exception
     * callback function
     */
    public function handle(Throwable $exception){
        $appHelper = new AppHelper(new Config());
        if($appHelper->isDebugMode()){
            echo '<pre>';
              var_dump($exception);
            echo '</pre>';
        }else{
            echo "This should have not happened! Please try again!";
        }
        exit;
    }

    /**
     * @throws \ErrorException
     */
    public function convertWarningAndNotice($severity, $message, $file, $line){
          throw new \ErrorException($message,$severity,$severity,$file,$line);
    }
}