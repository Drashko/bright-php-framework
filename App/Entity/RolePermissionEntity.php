<?php

namespace App\Entity;

use src\Entity\Entity;

class RolePermissionEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`role_permission`';

    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;

    private ?int $role_id = null;

    private ?int $permission_id = null;

    private ?string $created_at = null;

    private ?string $updated_at = null;


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
     * @return int|null
     */
    public function getRoleId(): ?int
    {
        return $this->role_id;
    }

    /**
     * @param int|null $role_id
     * @return RolePermissionEntity
     */
    public function setRoleId(?int $role_id): RolePermissionEntity
    {
        $this->role_id = $role_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPermissionId(): ?int
    {
        return $this->permission_id;
    }

    /**
     * @param int|null $permission_id
     * @return RolePermissionEntity
     */
    public function setPermissionId(?int $permission_id): RolePermissionEntity
    {
        $this->permission_id = $permission_id;
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
     * @return RolePermissionEntity
     */
    public function setCreatedAt(?string $created_at): RolePermissionEntity
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
     * @return RolePermissionEntity
     */
    public function setUpdatedAt(?string $updated_at): RolePermissionEntity
    {
        $this->updated_at = $updated_at;
        return $this;
    }


    /**
     * @return array
     */
    function mappedData(): array
    {
        return [
            'role_id'        => $this->getRoleId(),
            'permission_id'  => $this->getPermissionId(),
            'created_at'     => $this->getCreatedAt(),
            'updated_at'     => $this->getUpdatedAt()
        ];
    }
}