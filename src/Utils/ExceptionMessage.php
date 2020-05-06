<?php

namespace App\Utils;


use Throwable;

class ExceptionMessage extends \Exception
{

    public $strCode;

    function __construct(string $message = "", string $code = "0", Throwable $previous = null)
    {
        $this->strCode = $code;
        parent::__construct($message, (int)substr($code,3), $previous);
    }

    /**
     * @return string
     */
    public function getStrCode(): string
    {
        return $this->strCode;
    }

}