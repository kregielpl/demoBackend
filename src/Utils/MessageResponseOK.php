<?php

namespace App\Utils;


class MessageResponseOK extends MessageResponse
{
    /**
     * @param $data
     * @param $msg
     * @param array $addToArray dodatkowe parametry do zwrotu
     */
    public function init($data, $msg, $addToArray = array())
    {
        parent::initWithParams($data, $msg, Utils::CODE_OK, $state = Utils::STATE_OK, $addToArray);
    }

}