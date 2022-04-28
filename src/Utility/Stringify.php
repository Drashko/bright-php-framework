<?php

namespace src\Utility;

class Stringify
{
    /**
     * @param string $string
     * @return string
     */
    public static function studlyCaps(string $string) : string
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $string)));
    }

    /**
     * @param string $string
     * @return string
     */
    public static function camelCase(string $string) : string
    {
        return lcfirst(self::studlyCaps($string));
    }

}