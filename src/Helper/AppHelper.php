<?php
declare(strict_types=1);

namespace src\Helper;

use src\Config\Config;
use DateTimeInterface;
use Exception;

class AppHelper
{
    private Config $config;
    private mixed $conf_arr = [];

    public function __construct(Config $config){
        $this->config = $config;
        $this->conf_arr = $this->config->get('app');
    }

    /**
     * @throws \Exception
     */
    public function getServerTime() : DateTimeInterface{
        return new \DateTime('now', new \DateTimeZone('Europe/Sofia'));
    }

    public function isRunningFromConsole(): bool
    {
        return php_sapi_name() == 'cli' || php_sapi_name() == 'phpbg';
    }

    public function isDebugMode(){
        if(!isset($this->conf_arr['debug'])){
           return false;
        }
        return $this->conf_arr['debug'];
    }

    public function getEnvironment() : string{
        if(!isset($this->conf_arr['env'])){
            return 'production';
        }
        return ($this->isTestMode()) ? "test" : $this->conf_arr['env'];
    }

    /**
     * @throws \Exception
     */
    public function getLogPath(){
        if(!isset($this->conf_arr['log_path'])){
           throw  new Exception('Log path not defined!');
        }
        return $this->conf_arr['log_path'];
    }

    public function isTestMode() : bool {
        if($this->isRunningFromConsole() && defined("PHPUNIT_RUNNING") && PHPUNIT_RUNNING === true){
            return true;
        }else{
            return false;
        }
    }
}