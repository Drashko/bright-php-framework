<?php

namespace src\Factory;

use src\Template\Template;
use src\Template\TemplateInterface;


class TemplateFactory
{
    public static function make() : TemplateInterface {
        return new Template();
    }
}