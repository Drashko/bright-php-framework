<?php

namespace App\Service\Role;

interface RoleCreateServiceInterface
{
    public function create(array $data) : array | null;
}