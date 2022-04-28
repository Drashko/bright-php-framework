<?php
declare(strict_types=1);

namespace App\Repository\User;

use App\Entity\UserEntity;
use src\DataMapper\DataMapperInterface;

class UserCreateRepository implements UserCreateRepositoryInterface
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
     * @return UserEntity
     */
    public function create(UserEntity $userEntity) : UserEntity
    {
       $result = $this->dataMapper->create($userEntity);
       return $result->fetchAllInto(UserEntity::class)[0];

    }
}