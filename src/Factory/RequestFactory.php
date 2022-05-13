<?php

namespace src\Factory;

use JetBrains\PhpStorm\Pure;
use src\Utility\Request;

class RequestFactory
{
    #[Pure] public static function make() : Request {
        return new Request();
    }
}