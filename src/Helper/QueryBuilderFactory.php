<?php

namespace src\Helper;

use src\Config\Config;
use src\Database\PDOConnection;
use src\Exception\DatabaseException;
use src\QueryBuilder\QueryBuilder;

class QueryBuilderFactory
{

    /**
     * @throws DatabaseException
     */
    public static function make(string $credentialsType = "database" , string $connectionType = "pdo" , array $options = []): QueryBuilder
    {
         $config = new Config();//move to separate set method
         $connection = null;
         $credentials = array_merge($config->get($credentialsType, $connectionType), $options);
         $connection = (new PDOConnection($credentials))->connect();
         return new QueryBuilder($connection);
    }
}