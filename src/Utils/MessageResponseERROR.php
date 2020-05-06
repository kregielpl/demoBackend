<?php

namespace App\Utils;


class MessageResponseERROR extends MessageResponse
{
    /**
     * @param $data
     * @param $msg
     * @param $code
     */
    public function init($data, $msg, $code)
    {
        parent::initWithParams($data, $msg, $code, Utils::STATE_ERROR);
    }
}