<?php
declare(strict_types=1);

namespace src\QueryBuilder;

use InvalidArgumentException;
use PDO;
use PDOStatement;
use src\Database\DatabaseConnectionInterface;
use src\Entity\Entity;
use src\QueryBuilder\Exception\QueryBuilderException;
use src\QueryBuilder\QueryBuilderInterface;

class QueryBuilder implements QueryBuilderInterface
{

    protected string $sqlQuery = '';
    /**
     * @var PDO
     */
    protected PDO $pdo;//PDO
    /**
     * @var string
     */
    protected string $table;
    /**
     * @var \PDOStatement
     */
    protected \PDOStatement $statement;
    /**
     * @var array|null
     */
    protected  ?string  $fields;
    /**
     * @var array
     */
    protected  array $placeholders = [];

    /**
     * @var string
     */
    protected string $values = '';
    /**
     * @var array
     */
    protected array $data = [];
    /**
     * @var string
     */
    protected string $queryType = self::DML_TYPE_SELECT;//default type
    /**
     * @var array
     */
    protected array $joins = [];

    /**
     * @var array
     */
    protected array $orderBy = [];
    /**
     * @var array
     */
    protected array $groupBy = [];

    /**
     * @var array
     */
    protected array $limit = [];
    /**
     * @var array
     */
    protected array $offset = [];
    /**
     * @var array
     */
    protected array  $conditions = [];
    /**
     * default select
     */
    const COLUMNS = '*';
    const DML_TYPE_SELECT = 'SELECT';
    const DML_TYPE_INSERT = 'INSERT';
    const DML_TYPE_UPDATE = 'UPDATE';
    const DML_TYPE_DELETE = 'DELETE';

    /**
     * @var int
     */
    protected int $lastInsertId;

    /**
     * @param DatabaseConnectionInterface $databaseConnection
     */
    public function __construct(DatabaseConnectionInterface $databaseConnection){
        $this->pdo = $databaseConnection->getConnection();
    }

    /**
     * @param string $fields
     * @return $this
     * Select record from database
     */
    public function select(string $fields): self
    {
        $this->queryType = self::DML_TYPE_SELECT;
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param string $table
     * @param null $alias
     * @return $this
     */
    public function table(string $table, $alias = null): self
    {
        if ($alias === null) {
            $this->table  = $table;
        } else {
            $this->table = "${table} AS ${alias}";
        }
        return $this;
    }

    /**
     * @param string $type
     * @param string $table
     * @param $on
     * @return $this
     */
    public function join(string  $type, string $table, $on): self {
        $this->joins = [];
        $joinsArray[] = "{$type} JOIN {$table} ON {$on}";
        foreach($joinsArray as $join){
            $this->joins[] = $join;
        }
        return $this;
    }

    /**
     * @param string $field
     * @return $this
     */
    public function groupBy(string $field): self
    {
        $groupArray[] = " GROUP BY {$field}";
        foreach($groupArray as $group){
            $this->groupBy[] = $group;
        }
        return $this;
    }

    /**
     * @param string $field
     * @return $this
     */
    public function orderBy(string $field, string $direction = "ASC"): self
    {
        $orderArray[] = " ORDER BY {$field} {$direction}";
        foreach($orderArray as $order){
            $this->orderBy[] = $order;
        }
        return $this;
    }

    //TO DO - Bind WHERE id = :id ...
    public function where(array $condition): self{
        /*if($this->queryType != 'DELETE'){

        }*/
        //$this->conditions = [];
        //pr($condition);
        foreach ($condition as $key => $value) {
             if(!empty($key)){
                 //$this->conditions = $this->parseWhere($key, " = " , $value);
                 $this->conditions[] = "`{$key}`" . ' = ' .  " '$value'";
            }
       }
       /* if(!empty($this->conditions))
            $this->conditions = [];*/
        return $this;
    }

    public function parseWhere(string $field, string $operator, string | int $value): array
    {
        return  ["`{$field}`" . $operator .  " '$value'"];
    }

    /**
     * @param $limit
     * @return $this
     */
    public function limit($limit): self
    {
        $this->limit[] = "{$limit}";
        return $this;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function offset($offset): self {
        $this->offset[] = "{$offset}";
        return $this;
    }

    /**
     * INSERT INTO table ('name,'phone', 'email') VALUE(:name, :phone, :email);
     * @param array $data
     * create record in database
     */
    public function insert(array $data): self
    {
        $this->placeholders = [];
        $this->queryType = self::DML_TYPE_INSERT;
        $this->fields       = '`' . implode('`,`', array_keys($data)) . '`';
        $this->placeholders[] = ':' . implode(', :', array_keys($data));
        $this->data = $data;
        return $this;
    }

    /**
     * @param array $data
     * update record in database
     */
    public function update(array $data): self
    {
        $this->queryType = self::DML_TYPE_UPDATE;
        foreach($data as $key => $field){
                $this->values .= $key . " = :" .$key. ", ";
        }
        $this->values = substr_replace($this->values, '', -2);
        $this->data = $data;
        return $this;
    }

    /**
     * @return $this
     */
    public function delete(): self
    {
        $this->queryType = self::DML_TYPE_DELETE;
        return $this;
    }

    /**
     * @param $id
     * Find record by the provided id
     */
    public function find(int $id) : self
    {
        $this->select("*")->where(["Id => {$id}"]);
        return $this;
    }

    /**
     * @param string $field
     * @param $value
     * @return $this
     * to - refactor - add functionality to pass any logic inside where clause >,<, !=
     * possible solution - add additional argument to findOneBy with the needed operator
     * example findOneBy($filed, string $operation, $value) - $operation - '<', '<', '!=', '<='...
     */
    public function findOneBy(string $field , $value ) : self {
        $this->where([$field => $value]);
        return $this;
    }

    /**
     * @param array $condition
     * @return $this
     */
    public function findBy(array $condition) : self{
        $this->where($condition);
        return $this;
    }

    /**
     * @param string $type
     * @return string
     */
    public function getQuery(string $type): string
    {
        switch ($type){
            case self::DML_TYPE_SELECT :
                $limit      = array_filter($this->limit);
                $offset     = array_filter($this->offset);
                //Select ..
                $sqlQuery  = ' SELECT ' . $this->fields;
                $sqlQuery   = rtrim($sqlQuery , ', \t\n');
                $sqlQuery  .=  ' FROM ' . $this->table;
                //join
                $sqlQuery  .= implode(' ', $this->joins);
                if (!empty($this->conditions)) {
                    $where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
                }
                if(!empty($where)) {
                    $sqlQuery  .= $where;
                }
                //limit
                if(!empty($limit)){
                    $limit = $limit === [] ? '' : ' LIMIT ' . implode( ' ' , $this->limit);
                }
                //offset
                if(!empty($offset)){
                    $offset = $offset === [] ? '' : ' OFFSET ' . implode( ' ' , $this->offset);
                }
                //group by
                $sqlQuery  .= implode(' ', $this->groupBy);
                //order by
                $sqlQuery  .= implode(' ', $this->orderBy);
                //pr($sqlQuery);
                return $sqlQuery ;
                break;
            case self::DML_TYPE_INSERT :
                return   'INSERT INTO ' . $this->table . '( ' .$this->fields. ')' . ' VALUES ' . '(' . implode(' , ', $this->placeholders) . ')';
                break;
            case self::DML_TYPE_UPDATE :
                pr($this->conditions);
                $sqlQuery  = ' UPDATE ' .  $this->table;
                $sqlQuery .=  ' SET ' . $this->values;
                if (!empty($this->conditions)) {
                    $where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
                }
                if(!empty($where)) {
                    $sqlQuery .= $where;
                }
                pr($sqlQuery);
                return $sqlQuery;
                break;
            case self::DML_TYPE_DELETE :
                $sqlQuery =  'DELETE FROM ' . $this->table;
                if (!empty($this->conditions)) {
                    $where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
                }
                if(!empty($where)) {
                    $sqlQuery .= $where;
                }
                return $sqlQuery;
                break;
            default :
                throw new InvalidArgumentException('DML type not supported');
        }
    }
    /**
     * @param $value
     * @return int
     */
    public function bind($value): int
    {
        try{
            return match ($value) {
                is_bool($value) => PDO::PARAM_BOOL,
                intval($value) => PDO::PARAM_INT,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }catch(QueryBuilderException $exception){
            throw new $exception;
        }
    }

    /**
     * Execute select query :
     * $query->table('`users`', 'u')
     * ->select("*")
     * ->join(' LEFT', 'article  AS a ', 'u.id = a.userId')
     * ->where(["u.Id = 1"])
     * ->executeQuery()->fetchAll();
     * @return QueryBuilder
     */
    public function executeQuery() : self
    {
        $this->statement = $this->pdo->prepare($this->getQuery($this->queryType));
        $this->statement->execute();
        return $this;
    }

    /**
     * Used for insert ,update and delete operations
     * @return QueryBuilder
     * @throws QueryBuilderException
     */
    public function executeStatement() : self
    {
        //prepare
        $this->statement = $this->pdo->prepare($this->getQuery($this->queryType));
        //Needs refactoring - remove the if block , find another solution!!!
        if($this->queryType != 'DELETE')
            foreach ($this->data as $key => $value) {
                $this->statement->bindValue(':' . $key, $value, $this->bind($value));
            }
        $this->statement->execute();
        $this->lastInsertId = (int) $this->pdo->lastInsertId();
        return $this;
    }

    /**
     * fetch all records
     * @return mixed
     */
    public function fetchAllAssoc() : array {
            return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $className
     * @return int
     */
   /* public function fetchInto(string $className): array
    {
        return $this->statement->fetch(PDO::FETCH_CLASS, $className);
        //return (int) $this->pdo->lastInsertId();
    }*/

    /**
     * fetch one record
     * @return array|bool
     */
    public function fetchAssoc() : array | bool {
        if($this->statement->fetch() != false){
            return $this->statement->fetch();
        }
        return false;

    }

    /**
     * @param $
     * @return object
     */
    /* public function fetchObject() : object {
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }*/

    /**
     * @return array
     */
    public function fetchAllObject(string $className) : array {
        return $this->statement->fetchObject($className);
    }



    /**
     * map properties to class
     * @param string $className
     * @return array
     */
    public function fetchAllInto(string $className): array
    {
        $this->lastInsertId = (int) $this->pdo->lastInsertId();
        return $this->statement->fetchAll(PDO::FETCH_CLASS, $className);
    }

    /**
     * @return int
     */
    public function lastInsertedId(): int
    {
        return $this->lastInsertId;
    }


    /**
     * @param string $query
     * @return $this
     */
    public function raw(string $query): self
    {
        $this->pdo->prepare($query);
        return $this;
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