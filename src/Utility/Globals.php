<?php
declare(strict_types=1);

namespace src\Utility;

use InvalidArgumentException;

/**
 * Registry class used to add data to the views globally
 */
class Globals
{

       //consider being singleton ??

       private static array $globals = [];

      /* public function __construct(){
           //return self::getGlobals();
       }*/

       public static function add(string $key, mixed $values){
           self::$globals[$key]= $values;
       }

       public static function get(string $key){

           if (!isset(self::$globals[$key])) {
               throw new InvalidArgumentException('Invalid key given');
           }
           return self::$globals[$key];
       }

       public static function getGlobals(): array
       {
           return self::$globals;
       }
}