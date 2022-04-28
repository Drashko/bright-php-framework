<?php

namespace src\Helper;

use src\Config\Config;
use src\Database\PDOConnection;
use src\DataMapper\DataMapper;
use src\Exception\DatabaseException;
use src\QueryBuilder\QueryBuilder;

class DataMapperFactory
{


    /**
     * @throws DatabaseException
     */
    public static function make(string $credentialsType = "database" , string $connectionType = "pdo" , array $options = []) : DataMapper
     {
         $config = new Config();//move to separate set method
         $credentials = array_merge($config->get($credentialsType, $connectionType), $options);
         $connection = (new PDOConnection($credentials))->connect();
         $queryBuilder = (new QueryBuilder($connection));
         return new DataMapper($queryBuilder);
     }

}