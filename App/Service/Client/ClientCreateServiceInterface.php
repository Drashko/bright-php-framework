<?php

namespace App\Service\Client;

use App\Entity\ClientEntity;

interface ClientCreateServiceInterface
{
    public function create(array $data) : ClientEntity | null;
}