<?php

namespace App\Repository\User;

use App\Entity\UserEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class UserIdRepository implements UserIdRepositoryInterface
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
     * @param $id
     * @return UserEntity|bool
     */
    public function find($id): UserEntity | bool
    {
        $mapper = $this->dataMapper->findById('`users`', $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, UserEntity::class);
        return $mapper->fetch();
    }
}