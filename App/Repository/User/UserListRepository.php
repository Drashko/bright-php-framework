<?php

namespace App\Repository\User;


use App\Entity\UserEntity;
use src\DataMapper\DataMapperInterface;

class UserListRepository implements UserListRepositoryInterface
{
    /**
     * @var DataMapperInterface
     */
    private DataMapperInterface $dataMapper;
    /**
     * @param DataMapperInterface $dataMapper
     */
    public function __construct(DataMapperInterface $dataMapper)
    {
           $this->dataMapper = $dataMapper;
    }
    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions) : array
    {
       $userList = $this->dataMapper->findAll('`users`', array_filter($conditions));
       return $userList->fetchAllInto(UserEntity::class);
    }
}