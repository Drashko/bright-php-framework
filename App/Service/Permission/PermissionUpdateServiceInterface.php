<?php

namespace App\Service\Permission;

interface PermissionUpdateServiceInterface
{
    public function update( array $data, string $id) : mixed;
}