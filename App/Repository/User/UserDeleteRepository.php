<?php

namespace App\Repository\User;

use App\Entity\UserEntity;
use src\DataMapper\DataMapperInterface;

class UserDeleteRepository implements UserDeleteRepositoryInterface
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
     * @param UserEntity $userEntity
     * @param int $id
     * @return bool
     */
    public function delete(UserEntity $userEntity, int $id): bool
    {
        return $this->dataMapper->delete($userEntity, $id);
    }
}