<?php

namespace App\Entity;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use src\Entity\Entity;

class RoleEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`role`';

    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;

    private ?string $name = null;

    private ?string $description = null;

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
     * @return RoleEntity
     */
    public function setName(?string $name): RoleEntity
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
     * @return RoleEntity
     */
    public function setDescription(?string $description): RoleEntity
    {
        $this->description = $description;
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
     * @return RoleEntity
     */
    public function setCreatedAt(?string $created_at): RoleEntity
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
     * @return RoleEntity
     */
    public function setUpdatedAt(?string $updated_at): RoleEntity
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
            'created_at'     => $this->getCreatedAt(),
            'updated_at'     => $this->getUpdatedAt()
        ];
    }
}