<?php

namespace App\Repository\UserSession;

use App\Entity\UserSessionEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class UserSessionRepository implements UserSessionRepositoryInterface
{
    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper= $dataMapper;
    }

    /**
     * @return bool|UserSessionEntity
     */
    public function findByUserId($user_id): bool|UserSessionEntity
    {
       $mapper = $this->dataMapper->findOneBy('user_session', 'user_id' , $user_id);
       $mapper->setFetchMode(PDO::FETCH_CLASS, UserSessionEntity::class);
       return $mapper->fetch();

    }

    /**
     * @param $hash
     * @return bool|UserSessionEntity
     */
    public function findByHash($hash): bool|UserSessionEntity
    {
        $mapper = $this->dataMapper->findOneBy('user_session', 'hash' , $hash);
        $mapper->setFetchMode(PDO::FETCH_CLASS, UserSessionEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param UserSessionEntity $userSessionEntity
     * @return UserSessionEntity
     */
    public function create(UserSessionEntity $userSessionEntity): UserSessionEntity
    {
        $mapper = $this->dataMapper->create($userSessionEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, UserSessionEntity::class);
        return $mapper->fetch();
    }
}