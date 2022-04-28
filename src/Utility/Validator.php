<?php

namespace src\Utility;

class Validator
{

    private array $error;

    /**
     * @param string $email
     * @return mixed
     */
    public static function email(string $email): mixed
    {
        if (!empty($email)) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }
        return false;
    }

    /**
     * Function to validate a string against a blacklist.
     * @param string $string
     * @return bool
     */
    public static function assertAgainstSpecialCharsBlackList(string $string): bool
    {
        /* Blacklist of invalid characters. */
        $blacklist = array('&', '<', '>', '%', '@');
        foreach ($blacklist as $char)
        {
            if (mb_strpos($string, $char) !== false)
            {
                /* If the invalid character is found, the function returns FALSE. */
                return false;
            }
        }
        /* If no invalid characters are found inside the string, the function returns TRUE. */
        return true;
    }

    /**
     * @param string $value
     * @param $threshold
     * @return bool|void
     * min($value, 10) - the input must be at least 10 chars
     */
    public static function min(string $value, $threshold){
        if(!empty($threshold) AND !empty($value)){
            return !(strlen($value) <= $threshold);
        }
    }

    /**
     * @param string $value
     * @param $threshold
     * @return bool|void
     * max($value, 5) - the input must be maximum 5 chars
     */
    public static function max(string $value, $threshold){
        if(!empty($threshold) AND !empty($value)){
            return !(strlen($value) >= $threshold);
        }
    }

    /**
     * checks if the passed values contains only letters
     * @param $value
     * @return bool
     */
    public static function assertLetters($value): bool
    {
        if(preg_match('/.*[a-z]+.*/i', $value) == 0 ){
            return true;
        }else{
            return false;
        }

    }
    /**
     * checks if the passed values contains only numbers
     * @param $value
     * @return bool
     */
    public static function assertNumbers($value): bool
    {
        if(preg_match('/.*\d+.*/i', $value) == 0 ){
            return true;
        }else{
            return false;
        }
    }


}