<?php

namespace App\Entity;

use src\Entity\Entity;

class MessageEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`message`';

    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;

    private ?string $name = null;

    private ?string $email = null;

    private ?string $created_at = null;

    private ?int $status = null;
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
            'name'   => $this->getName(),
            'email'  => $this->getEmail(),
            'status'     => $this->getStatus(),
            'created_at' => $this->getCreatedAt()
        ];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return MessageEntity
     */
    public function setName(?string $name): MessageEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return MessageEntity
     */
    public function setEmail(?string $email): MessageEntity
    {
        $this->email = $email;
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
     * @return MessageEntity
     */
    public function setCreatedAt(?string $created_at): MessageEntity
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     * @return MessageEntity
     */
    public function setStatus(?int $status): MessageEntity
    {
        $this->status = $status;
        return $this;
    }


}