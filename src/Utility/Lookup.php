<?php

namespace src\Utility;

class Lookup
{

  public static function findIdName(array $array, mixed $match){
          foreach($array as $key => $value){
              if($value['id'] == $match){
                  return $value['name'];
              }
          }
  }
}