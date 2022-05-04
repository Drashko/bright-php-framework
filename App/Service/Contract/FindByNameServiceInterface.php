<?php

namespace App\Service\Contract;

use App\Entity\PermissionEntity;

interface FindByNameServiceInterface
{
       public function findByName(string $name) : bool | PermissionEntity;
}