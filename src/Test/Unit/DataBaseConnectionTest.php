<?php

namespace src\Test\Unit;

use PDO;
use PHPUnit\Framework\TestCase;

use src\Config\Config;
use src\Database\DatabaseConnectionInterface;
use src\Database\PDOConnection;
use src\Exception\DatabaseException;
use src\Exception\MissingArgumentException;

class DataBaseConnectionTest extends TestCase
{

    /**
     * @throws DatabaseException
     */
    public function testItCanConnectToDatabaseWithPdoApi(): PDOConnection|DatabaseConnectionInterface
    {
       //get credentials
       $credentials = $this->credentials('pdo');
       $pdo = (new PDOConnection($credentials))->connect();
       $this->assertInstanceOf(DatabaseConnectionInterface::class, $pdo);
        return $pdo;
   }

    /**
     * @depends testItCanConnectToDatabaseWithPdoApi
     */
    public function testItIsValidPdoConnection(DatabaseConnectionInterface $handler){
        $this->assertInstanceOf(PDO::class, $handler->getConnection());
    }
    /**
     * get database connection credentials and pass them to pdo
     */
   private function credentials(string $type): array
   {
       $config = new Config();
          return array_merge( $config->get('database' , $type), ['db_name' => 'mvc_testing'] //overwrite database name with 'mvc_testing'
       );
   }

}