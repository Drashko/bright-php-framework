<?php

namespace src\Database;

use src\Database\DatabaseConnectionInterface;
use src\Config\Config;
use src\Exception\DatabaseException;
use PDO;
use PDOException;

//changed before the class extended AbstractConnection class too and the property
class PDOConnection implements DatabaseConnectionInterface
{
    /**
     * array with all database connection keys
     */
    const REQUIRED_CONNECTION_KEYS = ['driver', 'host', 'db_name', 'db_user', 'db_pass', 'default_fetch'];
    /**
     * @var
     */
    protected PDO $connection;
    /**
     * @var array
     */
    //protected array $credentials
    /**
     * @throws DatabaseException
     * initialize PDO connection object with credentials
     */

    public function __construct(){

        try{
            $config = new Config();//TO DO - inject it through the constructor
            $configDB = $config->get('database', 'pdo');
            $credentials = $this->parseCredentials($configDB);
            $this->connection = new \PDO(...$credentials);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES ,  false);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }catch(PDOException $exception) {
            throw new DatabaseException($exception->getMessage(), $credentials, 500);
        }
        return $this->connection;
    }


    public function connect() : PDOConnection{

        return $this;
    }


    public function getConnection() : PDO
    {
        return $this->connection;
    }


    protected function parseCredentials(array $credentials): array
    {
        $dsn = sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
                    $credentials['driver'],
                    $credentials['host'],
                    $credentials['db_name'],
                    $credentials['charset'],
        );

        return [$dsn, $credentials['db_user'], $credentials['db_pass']];
    }
}