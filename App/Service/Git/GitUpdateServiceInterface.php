<?php

namespace App\Service\Git;

interface GitUpdateServiceInterface
{
    public function update( array $data, string $id) : mixed;

}