<?php

namespace App\Repository\UserSession;

use App\Entity\UserSessionEntity;
use src\DataMapper\DataMapperInterface;

class UserSession implements UserSessionInterface
{
    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper= $dataMapper;
    }

    /**
     * @return bool|UserSessionEntity
     */
    public function findByUserId($id): bool|UserSessionEntity
    {
        // TODO: Implement findByUserId() method.
    }

    /**
     * @param $hash
     * @return string
     */
    public function findByHash($hash): string
    {
        // TODO: Implement findByHash() method.
    }
}