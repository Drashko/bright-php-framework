<?php

namespace src\Utility;

class H
{

    /**
     * convert type casts array of objects to array list
     * @param object $objectList
     * @param string $namespace
     * @return array
     */
    public static function  castObjectToArray(array $objectList, string $namespace = ''): array{
        $out = [];
        array_walk_recursive($objectList , function(&$array, $k) use ($namespace, &$out) {
          $keys  = str_replace($namespace,"", array_keys((array) $array));
          $val   = array_values((array) $array);
          $out[] = array_combine($keys,$val);
        });
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