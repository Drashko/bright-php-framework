<?php

namespace App\Service\Client;

interface ClientUpdateServiceInterface
{
    public function update( array $data, string $id) : mixed;
}