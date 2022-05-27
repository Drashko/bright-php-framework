<?php

namespace src\Utility;

class H
{
    /**
     * convert type casts array of objects to array list
     * @param $objectList
     * @return array
     */
    public static function  castObjectToArray($objectList): array{
        $out = [];
        foreach ($objectList as $key => $array) {
            $out[] = (array) $array;
        }
        return $out;
    }

    /**
     * cleans html special chars form single value
     *
     * @param $value
     * @return string
     */
    public static function out($value): string
    {
        return htmlspecialchars($value);
    }

    /**
     * cleans html special chars from array
     *
     * @param array $data
     * @return array
     */
    public static function cleanOut(array $data): array
    {
        $out = [];
        foreach($data as $key => $value){
           $out[$key] =  htmlspecialchars($value);
        }
        return $out;
    }
}