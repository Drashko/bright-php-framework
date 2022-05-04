<?php

namespace App\Entity;

use src\Entity\Entity;

class UserSessionEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`user_session`';
    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;
    private ?int $user_id = null;
    private ?string $hash = null;
    /**
     * @return string
     */
    function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return int
     */
    function getId(): int
    {
        return (int) $this->Id;
    }

    /**
     * @return array
     */
    function mappedData(): array
    {
        return [
            'user_id'    => $this->getUserId(),
            'hash'       => $this->getHash(),
        ];
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     * @return UserSessionEntity
     */
    public function setUserId(?int $user_id): UserSessionEntity
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * @param string|null $hash
     * @return UserSessionEntity
     */
    public function setHash(?string $hash): UserSessionEntity
    {
        $this->hash = $hash;
        return $this;
    }
}