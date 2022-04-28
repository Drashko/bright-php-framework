<?php

namespace src\DataMapper;

use src\Entity\Entity;

interface DataMapperInterface
{
   public function find(string $table, int $id) : mixed;
   public function findAll(string $table, array $condition=[]) : mixed;
   public function findOneBy(string $table, string $field, $value) : mixed;
   public function create( Entity $entity): ?object;
   public function update( Entity $entity, $id): ?object;
   public function delete( Entity $entity, $id) : bool;
}