<?php

namespace App\Utils;


class Utils
{
    const STATE_OK = "OK";
    const STATE_ERROR = "ERROR";
    const CODE_OK = 200;
    const GLOBAL_ERROR = 1000;

    private static $env = 'prod';



    public static function objectToArray($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = self::objectToArray($value);
            }
            return $result;
        }
        return $data;
    }

    public static function setEnv($env)
    {
        self::$env = $env;
    }

    /**
     * @return mixed
     */
    public static function getEnv()
    {
        return self::$env;
    }

}