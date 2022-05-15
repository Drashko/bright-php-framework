<?php

namespace src\Utility;

use Exception;

class Sanitizer
{
    /**
     * Sanitization and filtering. The method accepts an array of argument which will
     * check  whether the value is of a 'string, integer or an array'. Uses
     * native PHP filtering.
     *
     * @param array $dirtyData - an associative array of key value pairs
     * @return array|null
     * @throws Exception
     */
    public static function clean(array $dirtyData = []) : ?array
    {
        $input = [];
        if (count($dirtyData) > 0) {
            foreach ($dirtyData as $key => $value) {
                if (!isset($key)) {
                    throw new Exception('Invalid key');
                }
                if (!is_array($value)) {
                    $value = trim(stripslashes((string) $value));
                }

                switch ($value) {
                    //Remove all characters except digits, plus and minus sign.
                    case is_int($value) :
                        $input[$key] = isset($value) ? filter_var($value, FILTER_SANITIZE_NUMBER_INT) : '';
                        break;
                    case is_string($value) :
                        //Strip tags and HTML-encode double and single quotes,
                        // optionally strip or encode special characters.
                        // Encoding quotes can be disabled by setting!
                        $input[$key] = isset($value) ? filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
                        break;
                    case is_array($value) :
                        if (count($value) > 0) {
                            foreach ($value as $arrKey => $arrValue) {
                                if (isset($arrKey) && $arrKey !='') {
                                    if (is_int($arrValue)) {
                                        $input[$arrKey] = isset($arrValue) ? filter_var($arrValue, FILTER_SANITIZE_NUMBER_INT) : '';
                                    } else {
                                        $input[$arrKey] = isset($arrValue) ? filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
                                    }
                                }
                            }
                        }
                        break;
                }
            }
            if (isset($input) && $input !='') {
                return $input;
            }
        }
        return [];
    }

    public function test(): string
    {
        return 'your are now in ' . __METHOD__ . ' in ' . __CLASS__;
    }
}