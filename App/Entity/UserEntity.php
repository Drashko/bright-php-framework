<?php

namespace App\Entity;
use src\Entity\Entity;

class UserEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`users`';
    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;
    private ?int $role_id = null;
    private ?string $name = null;
    private ?string $phone = null;
    private ?string $address = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $ip = null;
    private ?int $failedLogin = null;
    private ?string $status = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;
    private ?string $service = null;

    /**
     * @return string
     */
    public function getTable() : string {
        return $this->table;
    }
    /**
     * @return int
     */
    public function getId(): int
    {
       return (int) $this->Id;
    }

    /**
     * @return array
     */
    public function mappedData(): array
    {
        return [
            'role_id'    => $this->getRoleId(),
            'name'       => $this->getName(),
            'email'      => $this->getEmail(),
            'password'   => $this->getPassword(),
            'phone'      => $this->getPhone(),
            'address'      => $this->getAddress(),
            'status'       => $this->getStatus(),
            'created_at'     => $this->getCreatedAt(),
            'updated_at'     => $this->getUpdatedAt(),
            'service'        => $this->getService()
        ];
    }
    /**
     * @return ?int
     */
    public function getRoleId(): ?int
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     * @return UserEntity
     */
    public function setRoleId(int $role_id): UserEntity
    {
        $this->role_id = $role_id;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserEntity
     */
    public function setName(string $name): UserEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return UserEntity
     */
    public function setPhone(string $phone): UserEntity
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserEntity
     */
    public function setEmail(string $email): UserEntity
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return UserEntity
     */
    public function setPassword(?string $password): UserEntity
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string|null $ip
     * @return UserEntity
     */
    public function setIp(?string $ip): UserEntity
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFailedLogin(): ?int
    {
        return $this->failedLogin;
    }

    /**
     * @param int|null $failedLogin
     * @return UserEntity
     */
    public function setFailedLogin(?int $failedLogin): UserEntity
    {
        $this->failedLogin = $failedLogin;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return UserEntity
     */
    public function setStatus(string $status): UserEntity
    {
        $this->status = $status;
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
     * @param string $created_at
     * @return UserEntity
     */
    public function setCreatedAt(string $created_at): UserEntity
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
     * @param string $updated_at
     * @return UserEntity
     */
    public function setUpdatedAt(string $updated_at): UserEntity
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getService(): ?string
    {
        return $this->service;
    }

    /**
     * @param string $service
     * @return UserEntity
     */
    public function setService(string $service): UserEntity
    {
        $this->service = $service;
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
     * @return UserEntity
     */
    public function setAddress(?string $address): UserEntity
    {
        $this->address = $address;
        return $this;
    }


}