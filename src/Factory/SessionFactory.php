<?php

namespace src\Factory;

use JetBrains\PhpStorm\Pure;
use src\Session\Session;

class SessionFactory
{

       public static function make() : Session {
           return new Session();
       }
}