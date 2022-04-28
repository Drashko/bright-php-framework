<?php

namespace src\QueryBuilder;

use src\Entity\Entity;

interface QueryBuilderInterface
{
   public function table(string $table) : self;
   public function select(string $fields) : self;
   public function where(array $condition) : self;
   public function join(string  $type, string $table, $on) : self;
   public function raw(string $query) : self;
   public function insert(array $data): self;
   public function update(array $data): self;
   public function delete() : self;
   public function find(int $id) : self;
   public function lastInsertedId() : int;
   public function executeQuery() : self;
   public function executeStatement() : self;

}