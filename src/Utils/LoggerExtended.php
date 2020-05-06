<?php

namespace App\Utils;


use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LoggerExtended
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * LoggerExtended constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this -> logger,$name)){
            call_user_func_array(array($this -> logger, $name), $arguments);
        }
    }

    /**
     * @param $msg
     * @param array $context
     */
    public function info($msg, $context = array()){
        $this -> logger -> info($msg,$context);
    }

    /**
     * @param $msg
     * @param array $context
     */
    public function error($msg, $context = array()){
        $this -> logger -> error($msg,$context);
    }

}