<?php

namespace App\Entity;

use src\Entity\Entity;

class GitEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`git`';

    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;

    private ?string $name = null;


    private ?string $title = null;

    private ?string $description = null;

    private ?string $example = null;


    private ?string $position = null;

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
     * @return array
     */
    function mappedData(): array
    {
        return [
            'name'   => $this->getName(),
            'title'   => $this->getTitle(),
            'description'  => $this->getDescription(),
            'example'   => $this->getExample(),
            'position'   => $this->getPosition(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
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
     * @return GitEntity
     */
    public function setName(?string $name): GitEntity
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
     * @return GitEntity
     */
    public function setDescription(?string $description): GitEntity
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExample(): ?string
    {
        return $this->example;
    }

    /**
     * @param string|null $example
     * @return GitEntity
     */
    public function setExample(?string $example): GitEntity
    {
        $this->example = $example;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return GitEntity
     */
    public function setTitle(?string $title): GitEntity
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string|null $position
     * @return GitEntity
     */
    public function setPosition(?string $position): GitEntity
    {
        $this->position = $position;
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
     * @return GitEntity
     */
    public function setCreatedAt(?string $created_at): GitEntity
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
     * @return GitEntity
     */
    public function setUpdatedAt(?string $updated_at): GitEntity
    {
        $this->updated_at = $updated_at;
        return $this;
    }



}