<?php

namespace App\Entity;


use src\Entity\Entity;

class PermissionEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`permission`';

    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;

    private ?string $name = null;

    private ?string $description = null;

    private ?string $code = null;

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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return PermissionEntity
     */
    public function setName(?string $name): PermissionEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return PermissionEntity
     */
    public function setDescription(?string $description): PermissionEntity
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     * @return PermissionEntity
     */
    public function setCode(?string $code): PermissionEntity
    {
        $this->code = $code;
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
     * @return PermissionEntity
     */
    public function setCreatedAt(?string $created_at): PermissionEntity
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
     * @return PermissionEntity
     */
    public function setUpdatedAt(?string $updated_at): PermissionEntity
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
            'name'           => $this->getName(),
            'description'    => $this->getDescription(),
            'code'           => $this->getCode(),
            'created_at'     => $this->getCreatedAt(),
            'updated_at'     => $this->getUpdatedAt()
        ];
    }
}
