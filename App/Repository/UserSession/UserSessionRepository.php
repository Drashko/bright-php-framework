<?php

namespace App\Repository\UserSession;

use App\Entity\UserSessionEntity;
use PDO;
use src\DataMapper\DataMapperInterface;
use src\Utility\Token;

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
     * @throws \Exception
     */
    public function findByHash($hash): bool|UserSessionEntity
    {
        $token = new Token($hash);
        $token_hash = $token->getHash();
        $mapper = $this->dataMapper->findOneBy('user_session', 'hash' , $token_hash);
        $mapper->setFetchMode(PDO::FETCH_CLASS, UserSessionEntity::class);
        return $mapper->fetch();
    }


    /**
     * See if the remember token has expired or not, based on the current system time
     *
     * @return boolean True if the token has expired, false otherwise
     */
    public function hasExpired(): bool
    {
        return strtotime($this->expires_at) < time();
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


    /**
     * @param UserSessionEntity $userSessionEntity
     * @return bool
     */
    public function delete(UserSessionEntity $userSessionEntity, $id): bool
    {
        return $this->dataMapper->delete($userSessionEntity, $id);
    }
}