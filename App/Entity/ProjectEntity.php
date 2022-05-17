<?php

namespace App\Entity;

use src\Entity\Entity;

class ProjectEntity extends Entity
{
    /**
     * @var string
     */
    private string $table = '`project`';


    /**
     * primary table key
     * @var int|null
     */
    private ?int $Id = null;

    private ?int $manager_id = null;

    private ?int $client_id = null;

    private ?string $name = null;

    private ?string $description = null;

    private ?string $start_date = null;

    private ?string $end_date = null;

    private ?string $created_at = null;

    private ?string $updated_at = null;

    private ?string $status = null;



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
            'name'           => $this->getName(),
            'manager_id'     => $this->getManagerId(),
            'client_id'      => $this->getClientId(),
            'description'    => $this->getDescription(),
            'start_date'     => $this->getStartDate(),
            'end_date'       => $this->getEndDate(),
            'created_at'     => $this->getCreatedAt(),
            'updated_at'     => $this->getUpdatedAt(),
            'status'         => $this->getStatus(),
        ];
    }

    /**
     * @return int|null
     */
    public function getManagerId(): ?int
    {
        return $this->manager_id;
    }

    /**
     * @param int|null $manager_id
     * @return ProjectEntity
     */
    public function setManagerId(?int $manager_id): ProjectEntity
    {
        $this->manager_id = $manager_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getClientId(): ?int
    {
        return $this->client_id;
    }

    /**
     * @param int|null $client_id
     * @return ProjectEntity
     */
    public function setClientId(?int $client_id): ProjectEntity
    {
        $this->client_id = $client_id;
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
     * @return ProjectEntity
     */
    public function setName(?string $name): ProjectEntity
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
     * @return ProjectEntity
     */
    public function setDescription(?string $description): ProjectEntity
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->start_date;
    }

    /**
     * @param string|null $start_date
     * @return ProjectEntity
     */
    public function setStartDate(?string $start_date): ProjectEntity
    {
        $this->start_date = $start_date;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->end_date;
    }

    /**
     * @param string|null $end_date
     * @return ProjectEntity
     */
    public function setEndDate(?string $end_date): ProjectEntity
    {
        $this->end_date = $end_date;
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
     * @return ProjectEntity
     */
    public function setCreatedAt(?string $created_at): ProjectEntity
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
     * @return ProjectEntity
     */
    public function setUpdatedAt(?string $updated_at): ProjectEntity
    {
        $this->updated_at = $updated_at;
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
     * @param string|null $status
     * @return ProjectEntity
     */
    public function setStatus(?string $status): ProjectEntity
    {
        $this->status = $status;
        return $this;
    }

}