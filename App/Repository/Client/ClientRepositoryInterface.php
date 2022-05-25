<?php

namespace App\Repository\Client;

use App\Entity\ClientEntity;

interface ClientRepositoryInterface
{
    public function find($id) : ClientEntity;
    public function list(array $conditions) : array;
    public function create(ClientEntity $clientEntity) : ClientEntity;
    public function delete(ClientEntity $clientEntity, string $id) : bool;
    public function update(ClientEntity $clientEntity, string $id) : ClientEntity;
}