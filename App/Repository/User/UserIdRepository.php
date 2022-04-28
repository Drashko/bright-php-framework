<?php

namespace App\Repository\User;

use App\Entity\UserEntity;
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
     * @return UserEntity
     */
    public function find($id): UserEntity
    {
        $user = $this->dataMapper->findOneBy('`users`', 'id' , $id);
        return $user->fetchAllInto(UserEntity::class)[0];
    }
}