<?php

namespace src\Test\Unit;

use App\Repository\UserListRepository;
use App\Repository\UserListRepositoryInterface;
use PHPUnit\Framework\TestCase;
use src\DataMapper\DataDataMapper;
use src\Exception\DatabaseException;
use src\Helper\DataMapperFactory;

class UserListRepositoryTest extends TestCase
{
    private DataDataMapper $dataMapper;
    private UserListRepositoryInterface $userListRepository;

    /**
     * @throws DatabaseException
     */
    public function setUp(): void
    {
       $this->dataMapper = DataMapperFactory::make('database', 'pdo', ['db_name' => 'mvc_testing']);
       $this->userListRepository = new UserListRepository($this->dataMapper);
       parent::setUp();
    }

    public function testItCanGetAllRecordsFromTableUsers(){
           $list = $this->userListRepository->list();
           //var_export($list);
           $this->assertIsArray($list);
           $this->assertNotEmpty($list);
       }
}