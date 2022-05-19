<?php

namespace App\Entity;

use src\Entity\Entity;

class TaskEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`task`';

    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;
    private ?int $project_id = null;
    private ?int $user_id = null;
    private ?string $name = null;
    private ?string $text = null;
    private ?int $status = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;


    /**
     *
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
            'project_id'   => $this->getProjectId(),
            'user_id'   => $this->getUserId(),
            'name'   => $this->getName(),
            'text'   => $this->getText(),
            'status'     => $this->getStatus(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }

    /**
     * @return int|null
     */
    public function getProjectId(): ?int
    {
        return $this->project_id;
    }

    /**
     * @param int|null $project_id
     * @return TaskEntity
     */
    public function setProjectId(?int $project_id): TaskEntity
    {
        $this->project_id = $project_id;
        return $this;
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
     * @return TaskEntity
     */
    public function setUserId(?int $user_id): TaskEntity
    {
        $this->user_id = $user_id;
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
     * @return TaskEntity
     */
    public function setName(?string $name): TaskEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return TaskEntity
     */
    public function setText(?string $text): TaskEntity
    {
        $this->text = $text;
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
     * @return TaskEntity
     */
    public function setStatus(?int $status): TaskEntity
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
     * @param string|null $created_at
     * @return TaskEntity
     */
    public function setCreatedAt(?string $created_at): TaskEntity
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
     * @return TaskEntity
     */
    public function setUpdatedAt(?string $updated_at): TaskEntity
    {
        $this->updated_at = $updated_at;
        return $this;
    }


}