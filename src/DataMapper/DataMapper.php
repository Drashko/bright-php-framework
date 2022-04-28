<?php

namespace src\DataMapper;

use src\Entity\Entity;
use src\QueryBuilder\Exception\QueryBuilderException;
use src\QueryBuilder\QueryBuilderInterface;

class DataMapper implements DataMapperInterface
{
    /**
     * @var QueryBuilderInterface
     */
    private QueryBuilderInterface $queryBuilder;

    /**
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(QueryBuilderInterface $queryBuilder){
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @return QueryBuilderInterface
     */
    public function find(string $table, int $id): QueryBuilderInterface
    {
        return $this->queryBuilder->table($table)->select("*")->where(["Id => {$id}"])->executeQuery();
    }

    /**
     * @return QueryBuilderInterface
     */
    public function findAll(string $table , array $condition = []): QueryBuilderInterface
    {
        return $this->queryBuilder->table($table)->select("*")->where($condition)->executeQuery();
    }


    /**
     * @param string $table
     * @param string $field
     * @param $value
     * @return mixed
     */
    public function findOneBy(string $table, string $field, $value): mixed
    {
        return $this->queryBuilder->table($table)->select("*")->findOneBy($field,$value)->executeQuery();
    }

    /**
     * @param Entity $entity
     * @return object|null
     */
    public function create(Entity $entity) : ?object {
        $this->queryBuilder->table($entity->getTable())->insert(array_filter($entity->mappedData()))->executeStatement();
        return $this->queryBuilder->find($this->queryBuilder->lastInsertedId())->executeQuery();
    }

    /**
     * @param Entity $entity
     * @param $id
     * @return object|null
     */
    public function update(Entity $entity, $id): ?object
    {
        $this->queryBuilder->table($entity->getTable())->update(array_filter($entity->mappedData()))->where(["Id => {$id}"])->executeStatement();
        return $this->queryBuilder->find($id)->executeQuery();
    }

    /**
     * @param Entity $entity
     * @param $id
     * @return bool
     */
    public function delete(Entity $entity, $id): bool
    {
       if($this->queryBuilder->table($entity->getTable())->delete()->where(["Id => {$id}"])->executeStatement()){
           return true;
       }
       return false;
    }


}