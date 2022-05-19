<?php

namespace App\Entity;

use src\Entity\Entity;

class ClientEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`client`';

    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;
    private ?int $owner_id = null;
    private ?string $name = null;
    private ?string $address = null;
    private ?string $phone = null;
    private ?string $vat = null;
    private ?string $email = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;
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
            'owner_id'   => $this->getOwnerId(),
            'name'   => $this->getName(),
            'email'  => $this->getEmail(),
            'address'   => $this->getAddress(),
            'phone'   => $this->getPhone(),
            'vat'     => $this->getVat(),
            'status'     => $this->getStatus(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }

    /**
     * @return int|null
     */
    public function getOwnerId(): ?int
    {
        return $this->owner_id;
    }

    /**
     * @param int|null $owner_id
     * @return ClientEntity
     */
    public function setOwnerId(?int $owner_id): ClientEntity
    {
        $this->owner_id = $owner_id;
        return $this;
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
     * @return ClientEntity
     */
    public function setName(?string $name): ClientEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return ClientEntity
     */
    public function setAddress(?string $address): ClientEntity
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return ClientEntity
     */
    public function setPhone(?string $phone): ClientEntity
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVat(): ?string
    {
        return $this->vat;
    }

    /**
     * @param string|null $vat
     * @return ClientEntity
     */
    public function setVat(?string $vat): ClientEntity
    {
        $this->vat = $vat;
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
     * @return ClientEntity
     */
    public function setEmail(?string $email): ClientEntity
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
     * @return ClientEntity
     */
    public function setCreatedAt(?string $created_at): ClientEntity
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @param string|null $updated_at
     * @return ClientEntity
     */
    public function setUpdatedAt(?string $updated_at): ClientEntity
    {
        $this->updated_at = $updated_at;
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
     * @return ClientEntity
     */
    public function setStatus(?int $status): ClientEntity
    {
        $this->status = $status;
        return $this;
    }


}