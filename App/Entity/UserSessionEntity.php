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
    private ?string $expires_at = null;
    private ?string $created_at = null;
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
            'expires_at' => $this->getExpiresAt(),
            'created_at' => $this->getCreatedAt(),
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

    /**
     * @return string|null
     */
    public function getExpiresAt(): ?string
    {
        return $this->expires_at;
    }

    /**
     * @param string|null $expires_at
     * @return UserSessionEntity
     */
    public function setExpiresAt(?string $expires_at): UserSessionEntity
    {
        $this->expires_at = $expires_at;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * @param string|null $created_at
     * @return UserSessionEntity
     */
    public function setCreatedAt(?string $created_at): UserSessionEntity
    {
        $this->created_at = $created_at;
        return $this;
    }


}