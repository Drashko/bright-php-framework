<?php

namespace src\Test\Unit;

use App\Domain\Entities\BugReportEntity;
use App\Entity\UserEntity;
use PHPUnit\Framework\TestCase;
use src\Database\PDOConnection;
use src\DataMapper\DataMapper;
use src\DataMapper\DataMapperInterface;
use src\Helper\DataMapperFactory;
use src\QueryBuilder\QueryBuilder;
use src\QueryBuilder\QueryBuilderInterface;

class DataMapperTest extends TestCase
{
    protected DataMapper $dataMapper;

    /**
     * @throws \src\Exception\DatabaseException
     */
    public function setUp(): void
    {

        $this->dataMapper = DataMapperFactory::make('database', 'pdo', ['db_name' => 'mvc_testing']);
        parent::setUp();
    }

    public function testItCanFindAllRecordsFromTable(){
        $userList = $this->dataMapper->findAll('`users`');
        $results = $userList->fetchAllInto(UserEntity::class);
        $this->assertNotEmpty($results);
    }

    public function testItCanFindRecordInTable(){
        $userList = $this->dataMapper->find('`users`', 2);
        $results = $userList->fetchAllInto(UserEntity::class);
        //var_export($results);
        $this->assertNotEmpty($results);
        $this->assertIsArray($results);
    }


    public function testItCanCreateAnewEntity(){
        $newUser = $this->createUser();
        $this->assertInstanceOf(UserEntity::class, $newUser);
    }
    public function testItCanUpdateGivenEntity(){
        //create new user
        $newUser = $this->createUser();

        //find the newly record
        $newFound = $this->dataMapper->find('`users`', $newUser->getId());
        $newFound = $newFound->fetchAllInto(UserEntity::class)[0];

        $newFound->setFirstName('GG')->setLastName('GG');

        $update = $this->dataMapper->update($newFound, $newUser->getId())->fetchAllInto(UserEntity::class);
        $this->assertInstanceOf(UserEntity::class, $newFound);
        $this->assertSame("GG", $newFound->getFirstName());
        $this->assertSame("GG", $newFound->getLastName());

    }
    public function testItCanDeleteGivenEntity(){
        //create new user
        $newUser = $this->createUser();
        $newFound = $this->dataMapper->find('`users`', $newUser->getId())->fetchAllInto(UserEntity::class)[0];
        $result = $this->dataMapper->delete($newFound, (int) $newFound->getId());
        $this->assertIsBool($result);

    }


    private function createUser(): UserEntity
    {
        $user = new UserEntity();
        $user->setFirstName('test')
             ->setLastName('Hello message')
             ->setPhone('123456')
             ->setEmail('email@test.com');
        return $this->dataMapper->create($user)->fetchAllInto(UserEntity::class)[0];
    }
}