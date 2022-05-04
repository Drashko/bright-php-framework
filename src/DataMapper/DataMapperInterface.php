<?php

namespace src\DataMapper;

use src\Entity\Entity;

interface DataMapperInterface
{
    public function findById(string $table, string $id) : mixed;
    public function findAll(string $table, array $condition=[]) : mixed;
    public function create( Entity $entity): ?object;
    public function update( Entity $entity, string $id): ?object;
    public function delete( Entity $entity, string $id) : bool;
    public function raw(string $sql);
}