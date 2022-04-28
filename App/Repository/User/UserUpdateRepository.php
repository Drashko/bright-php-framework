<?php

namespace App\Repository\User;


use App\Entity\UserEntity;
use src\DataMapper\DataMapperInterface;


class UserUpdateRepository implements UserUpdateRepositoryInterface
{
    private DataMapperInterface $dataMapper;

    /**
     * @param DataMapperInterface $dataMapper
     */
    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param UserEntity $userEntity
     * @param $id
     * @return UserEntity
     */
    public function update(UserEntity $userEntity, $id): UserEntity
    {
       $result = $this->dataMapper->update($userEntity, $id);
       return $result->fetchAllInto(UserEntity::class)[0];
    }
}