<?php

namespace src\Factory;

use JetBrains\PhpStorm\Pure;
use src\Utility\Input;

class InputFactory
{
    #[Pure] public static function make() : Input {
        return new Input();
    }
}