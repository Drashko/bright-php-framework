<?php

namespace App\Service\Role;

interface RoleUpdateServiceInterface
{
    public function update( array $data, string $id) : mixed;
}