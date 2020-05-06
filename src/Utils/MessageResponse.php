<?php

namespace App\Utils;


use Symfony\Component\HttpFoundation\JsonResponse;

class MessageResponse extends JsonResponse
{
    private $msgData;
    private $state;

    /**
     * @param $data
     * @param $msg
     * @param $code
     * @param $state
     * @param array $addToArray dodatkowe parametry
     */
    public function initWithParams($data, $msg, $code, $state, $addToArray = array())
    {
        $this -> state = $state;
        $this -> msgData = array(
            "msg" => $msg,
            "code" => $code,
            "state" => $state,
            "data" => $data,
        );
        $this -> msgData = array_merge($this -> msgData,$addToArray);
        $this->setData($this->msgData);
    }

    /**
     * @param $msg
     * @param LoggerExtended $logger
     * @return $this
     */
    public function addToLogResponse($msg,LoggerExtended $logger) : MessageResponse{
        if ($this -> isStateOK()) {
            $logger->info($msg . ": " . print_r($this->msgData, true));
        }else {
            $logger->error($msg . ": " . print_r($this->msgData, true));
        }
        return $this;
    }

    public function toLog($toLog, LoggerExtended $logger)
    {
        if ($toLog) {
            $this->addToLogResponse($toLog, $logger);
        }
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this-> state;
    }

    /**
     * @return bool
     */
    public function isStateOK()
    {
        return $this-> state == Utils::STATE_OK;
    }

    /**
     * @return bool
     */
    public function isStateERROR()
    {
        return $this-> state == Utils::STATE_ERROR;
    }

    public function getData()
    {
        if (!isset($this -> msgData["data"])) return null;
        return $this -> msgData["data"];
    }

    public function getMsg()
    {
        if (!isset($this -> msgData["msg"])) return null;
        return $this -> msgData["msg"];
    }

}