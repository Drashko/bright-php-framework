<?php

namespace App\Service\User;


use App\Entity\UserEntity;
use App\Repository\User\UserIdRepositoryInterface;

class UserFindIdService implements UserFindIdServiceInterface
{
    /**
     * @var UserIdRepositoryInterface
     */
    public UserIdRepositoryInterface $userIdRepository;

    /**
     * @param UserIdRepositoryInterface $userIdRepository
     */
    public function __construct(UserIdRepositoryInterface $userIdRepository){
        $this->userIdRepository = $userIdRepository;
    }

    /**
     * @param string $id
     * @return UserEntity
     */
    public function find(string $id): UserEntity
    {
        return $this->userIdRepository->find($id);
    }
}