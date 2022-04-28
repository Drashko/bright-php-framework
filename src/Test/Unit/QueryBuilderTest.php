<?php

namespace src\Test\Unit;

use App\Entity\UserEntity;
use PHPUnit\Framework\TestCase;
use src\Exception\DatabaseException;
use src\Helper\QueryBuilderFactory;
use src\QueryBuilder\Exception\QueryBuilderException;

class QueryBuilderTest extends TestCase
{
    private $queryBuilder;

    /**
     * @throws DatabaseException
     */
    public function setUp(): void
    {
        $this->queryBuilder = QueryBuilderFactory::make('database','pdo', ['db_name' => 'mvc_testing']);
        parent::setUp();
    }

    public function testItCanSelectRecords(){
      $result = $this->queryBuilder->table('users')->select("*")->executeQuery();
      $result =   $result->fetchAllInto(UserEntity::class);
      //var_dump($result);
      $this->assertIsArray($result);
    }

    /**
     * @throws QueryBuilderException
     */
    public function testItCanInsertRecord(){
      $newUser = $this->queryBuilder->table('users')->insert(['first_name' => 'DR', 'last_name' => 'ST'])->executeStatement();
      $newUser =  $newUser->fetchAllInto(UserEntity::class);
      $this->assertIsArray($newUser);
      $this->assertNotNull($newUser);
    }

    /**
     * @throws QueryBuilderException
     */
    public function testItCanUpdateRecord(){
       $update = $this->queryBuilder
           ->table('users')
           ->update(['first_name' => 'DR', 'last_name' => 'ST'])
           ->where(["Id = 1"])
           ->executeStatement();
       $update = $update->fetchAllInto(UserEntity::class);
       $this->assertIsArray($update);

   }

    /**
     * @throws QueryBuilderException
     */
    public function testItCanDeleteRecord(){
       $update = $this->queryBuilder
           ->table('users')
           ->delete()
           ->where(["Id = 1"])
           ->executeStatement();
       //var_dump($update);
        $find = $this->queryBuilder->table('`users`')->find('1')->executeQuery();
        $res = $find->fetchAssoc();
        print_r($res);
       $this->assertEmpty($res);
       $this->assertIsBool($res);
   }

}