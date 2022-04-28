<?php

namespace App\Service\Permission;

interface PermissionCreateServiceInterface
{
    public function create(array $data) : array | null;
}