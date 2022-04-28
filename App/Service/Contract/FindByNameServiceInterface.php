<?php

namespace App\Service\Contract;

interface FindByNameServiceInterface
{
       public function findByName(string $name) : array;
}