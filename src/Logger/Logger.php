<?php

namespace src\Logger;

use Exception;
use src\Config\Config;
use src\Exception\InvalidLogLevelArgumentException;
use src\Helper\AppHelper;
use ReflectionClass;

class Logger implements LoggerInterface
{

    /**
     * @throws Exception
     */
    public function emergency(string $message, array $context = array())
    {
        $this->addRecord(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * @throws Exception
     */
    public function alert(string $message, array $context = array())
    {
        $this->addRecord(LogLevel::ALERT, $message, $context);
    }

    /**
     * @throws Exception
     */
    public function critical(string $message, array $context = array())
    {
        $this->addRecord(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * @throws Exception
     */
    public function error(string $message, array $context = array())
    {
        $this->addRecord(LogLevel::ERROR , $message, $context);
    }

    /**
     * @throws Exception
     */
    public function warning(string $message, array $context = array())
    {
        $this->addRecord(LogLevel::WARNING, $message, $context);
    }

    /**
     * @throws Exception
     */
    public function notice(string $message, array $context = array())
    {
        $this->addRecord(LogLevel::NOTICE, $message, $context);
    }

    /**
     * @throws Exception
     */
    public function info(string $message, array $context = array())
    {
        $this->addRecord(LogLevel::INFO, $message, $context);
    }

    /**
     * @throws Exception
     */
    public function debug(string $message, array $context = array())
    {
        $this->addRecord(LogLevel::DEBUG, $message, $context);
    }

    /**
     * @throws InvalidLogLevelArgumentException
     * @throws Exception
     */
    public function log(mixed $level, string $message, array $context = array())
    {
        $object = new ReflectionClass(LogLevel::class);
        $levelArray = $object->getConstants();
        if(!in_array($level, $levelArray)){
            throw new InvalidLogLevelArgumentException($level, $levelArray);
        }
        $this->addRecord($level, $message, $context);
    }

    /**
     * @throws Exception
     */
    public function addRecord($level, string $message, array $context = []){
        $app = new AppHelper(new Config());
        $date = $app->getServerTime()->format('Y-m-d y:s:i');
        $logPath = $app->getLogPath();
        $env = $app->getEnvironment();
        //file raw log details
        $details = sprintf("%s - Level: %s - Message: %s - Context: %s", $date, $level, $message, json_encode($context).PHP_EOL);
        //set file name
        $fileName = sprintf("%s/%s-%s.log",$logPath, $env, date("j.n.Y"));
        //create file and save the data
        file_put_contents($fileName, $details , FILE_APPEND);
    }
}