<?php

namespace App\Service\Project;

interface ProjectUpdateServiceInterface
{
    public function update( array $data, string $id) : mixed;
}