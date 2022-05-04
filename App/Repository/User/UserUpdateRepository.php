<?php

namespace App\Repository\User;


use App\Entity\UserEntity;
use PDO;
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
        $mapper = $this->dataMapper->update($userEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, UserEntity::class);
        return $mapper->fetch();
    }
}