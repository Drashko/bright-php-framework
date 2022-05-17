<?php

namespace src\Exception;

use src\Config\Config;
use src\Template\Template;
use Throwable;
use src\Helper\AppHelper;

class ExceptionHandler
{

    /**
     * @param Throwable $exception
     * callback function
     * @throws NotFoundException
     */
    public function handle(Throwable $exception){
        $appHelper = new AppHelper(new Config());
        if($appHelper->isDebugMode()){
            echo '<pre>';
              var_dump($exception);
            echo '</pre>';
        }else{
            $template = new Template();
            $template->render('/Layout/404');

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