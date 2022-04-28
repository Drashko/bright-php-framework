<?php

namespace src\Factory;

use JetBrains\PhpStorm\Pure;
use src\Config\Config;

class ConfigFactory
{
    #[Pure] public static function make() : Config {
        return new Config();
    }
}