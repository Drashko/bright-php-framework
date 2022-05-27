<?php
declare(strict_types=1);

namespace src\DataMapper;

use src\Database\DatabaseConnectionInterface;
use src\Entity\Entity;
use PDO;
use PDOStatement;

class DataMapper implements DataMapperInterface
{
    private DatabaseConnectionInterface $connection;

    private PDO $pdo;

    /**
     * @param DatabaseConnectionInterface $connection
     */
    public function __construct(DatabaseConnectionInterface $connection){
        $this->connection = $connection;
        $this->pdo = $this->connection->getConnection();
    }

    /**
     * @param string $table
     * @param string $id
     * @return mixed
     */
    public function findById(string $table ,string  $id) : mixed {
        $stm = $this->pdo->prepare("SELECT * FROM {$table} WHERE `id` = :id ");
        $stm->bindValue(':id', $id ,  PDO::PARAM_INT);
        $stm->execute();
        return $stm;
    }


    public function parseWhere(array $conditions): string
    {
        $where = [];
        foreach (array_filter($conditions) as $key => $value) {
            if(!empty($key)){
                if($key == 'created_at'){
                    $keyData = "DATE($key)";
                    $where[] = "{$keyData}" . " ="  . " :$key";
                    unset($key);
                }else{
                    $where[] = "{$key}" . " = " . ":".substr($key, strpos($key, '.') + 1);//remove alies from param
                   //$where[] = "{$key}" . " = " . ":$key";
                }
            }
        }
        if (!empty($where)) {
            $where = ' WHERE ' . implode(' AND ', $where);
        }else{
            $where = ' WHERE  1';
        }

        return $where;
    }

    /**
     * @param string $table
     * @param array $condition
     * @return mixed
     */
    public function findAll(string $table , array $condition = [], int $limit = null, int $offset = null) : mixed {
        $where = '';
        $offsetLimit = '';
        $where = $this->parseWhere($condition);
        if(isset($offset) && isset($limit)){
            $offsetLimit  = 'LIMIT ' . $offset . ',' . $limit;
        }
        $sql = "SELECT  * FROM {$table} {$where} {$offsetLimit}";
        $stm = $this->pdo->prepare($sql);
        if(!empty($condition)){
            foreach(array_filter($condition) as $key => $value){
                $stm->bindValue($key , $value ,  $this->bind($value));
            }
        }
        $stm->execute();
        return $stm;
    }

    /**
     * @param string $table
     * @param string $field
     * @param string $value
     * @return mixed
     */
    public function findOneBy(string $table, string $field , string $value): mixed
    {
        $fields = "`{$field}`" . "=" . " :{$field}";
        $stm = $this->pdo->prepare("SELECT  *  FROM {$table} WHERE {$fields}");
        $stm->bindValue($field, $value, $this->bind($value));
        $stm->execute();
        return $stm;
    }
    /**
     * @param Entity $entity
     * @return object
     */
    public function create(Entity $entity): object
    {
        $data           = array_filter($entity->mappedData());
        $fields         =  '`' . implode('`,`', array_keys($data)) . '`';
        $placeholders   = ':' . implode(', :', array_keys($data));
        $stm = $this->pdo->prepare("INSERT INTO  {$entity->getTable()} ({$fields}) VALUES ({$placeholders})");
        foreach($data as $key => $value){
            $stm->bindValue($key , $value ,  $this->bind($value));
        }
        $stm->execute();
        $lastId = $this->pdo->lastInsertId();
        $stm->fetch();
        return $this->findById($entity->getTable(), $lastId);
    }

    /**
     * @param Entity $entity
     * @param string $id
     * @return object
     */
    public function update(Entity $entity, string $id) : object{
        $data   = array_filter($entity->mappedData());
        $fields = '';
        foreach($data as $key => $value){
            $fields .= $key . " = :" .$key. ", ";
        }
        $fields = substr_replace($fields, '', -2);
        $stm = $this->pdo->prepare("UPDATE {$entity->getTable()} SET {$fields} WHERE id = :id");
        foreach($data as $key => $value){
            $stm->bindValue('id', $id, PDO::PARAM_INT);
            $stm->bindValue($key , $value ,  $this->bind($value));
        }
        $stm->execute();
        return $this->findById($entity->getTable(), (string) $id);
    }

    /**
     * @param Entity $entity
     * @param string $id
     * @return bool
     */
    public function delete(Entity $entity, string $id): bool
    {
        if($this->findById($entity->getTable(), $id)){
            $stm = $this->pdo->prepare( "DELETE FROM  {$entity->getTable()} WHERE id = :id");
            $stm->bindValue('id', $id, PDO::PARAM_INT);
            $stm->execute();
            return true;
        }
        return false;
    }

    /**
     * @param $table
     * @param string $id
     * @return bool
     */
    public function simpleDelete($table, string $id): bool
    {
        $stm = $this->pdo->prepare( "DELETE FROM  {$table} WHERE id = :id");
        $stm->bindValue('id', $id, PDO::PARAM_INT);
        $stm->execute();
        return true;
    }

    /**
     * @param string $sql
     */
    public function raw(string $sql): bool|PDOStatement
    {
        return $this->pdo->prepare($sql);
    }



    /**
     * @param $statement
     * @param string $className
     * @return mixed
     */
    public function fetchInto($statement, string $className): mixed
    {
        $statement->setFetchMode(PDO::FETCH_CLASS, $className);
        return $statement->fetch();
    }

    /**
     * @param $statement
     * @param string $className
     * @return mixed
     */
    public function fetchAllInto($statement, string $className): mixed
    {
        $statement->setFetchMode(PDO::FETCH_CLASS, $className);
        return $statement->fetchAll();
    }

    /**
     * fetch one record
     * @param $statement
     * @return array|bool
     */
    public function fetchAssoc($statement) : array | bool {
        if($statement->fetch() != false){
            return $statement->fetch();
        }
        return false;

    }

    /**
     * fetch all records
     * @return mixed
     */
    public function fetchAllAssoc($statement) : array {
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $value
     * @return int
     */
    public function bind($value): int
    {
        return match ($value) {
            is_bool($value) => PDO::PARAM_BOOL,
            intval($value) => PDO::PARAM_INT,
            is_null($value) => PDO::PARAM_NULL,
            default => PDO::PARAM_STR,
        };
    }

    /**
     * PDO transactions init
     */
     public function beginTransaction(){
        $this->pdo->beginTransaction();
     }

    /**
     * Pdo commit transaction
     */
     public function commit(){
         $this->pdo->commit();
     }

    /**
     * rollback incomplete transaction
     */
     public function rollBack(){
         $this->pdo->rollBack();
     }
    /**
     * Group list of items by column name
     *
     * @param $list
     * @param $group
     * @return array
     */
    public function group($list, $group): array {
        $result = array();
        foreach($list as $id => $item){
            //$result[$item[$group]][] = $item;
            $column = $item[$group];
            //unset($item[$by_column]);
            $result[$column][] = $item;
        }
        return $result;
    }

}