<?php

namespace App\Entity;

use src\Entity\Entity;

class ActivityEntity extends Entity
{

    /**
     * @var string
     */
    private string $table = '`activity`';

    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;
    private ?int $project_id = null;
    private ?int $task_id = null;
    private ?int $user_id = null;
    private ?string $name = null;
    private ?string $description = null;
    private ?int $status = null;
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
            'project_id'    => $this->getProjectId(),
            'user_id'       => $this->getUserId(),
            'task_id'       => $this->getTaskId(),
            'name'          => $this->getName(),
            'description'   => $this->getDescription(),
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
     * @return ActivityEntity
     */
    public function setProjectId(?int $project_id): ActivityEntity
    {
        $this->project_id = $project_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTaskId(): ?int
    {
        return $this->task_id;
    }

    /**
     * @param int|null $task_id
     * @return ActivityEntity
     */
    public function setTaskId(?int $task_id): ActivityEntity
    {
        $this->task_id = $task_id;
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
     * @return ActivityEntity
     */
    public function setUserId(?int $user_id): ActivityEntity
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
     * @return ActivityEntity
     */
    public function setName(?string $name): ActivityEntity
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
     * @return ActivityEntity
     */
    public function setDescription(?string $description): ActivityEntity
    {
        $this->description = $description;
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
     * @return ActivityEntity
     */
    public function setStatus(?int $status): ActivityEntity
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
     * @return ActivityEntity
     */
    public function setCreatedAt(?string $created_at): ActivityEntity
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
     * @return ActivityEntity
     */
    public function setUpdatedAt(?string $updated_at): ActivityEntity
    {
        $this->updated_at = $updated_at;
        return $this;
    }


}