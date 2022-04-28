<?php
declare(strict_types=1);

namespace src\Template;

interface TemplateInterface
{
    public function render(string $template, array $data = [], $layout='') : void;
}