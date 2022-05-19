<?php

namespace App\Repository\Task;

use App\Entity\ClientEntity;
use App\Entity\TaskEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class TaskRepository implements TaskRepositoryInterface
{

    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param $id
     * @return TaskEntity
     */
    public function find($id): TaskEntity
    {
        $mapper = $this->dataMapper->findById('`client`', $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, TaskEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {
        $mapper = $this->dataMapper->findAll('`task`', $conditions);
        return $this->dataMapper->fetchAllInto($mapper,TaskEntity::class);
    }

    /**
     * @param TaskEntity $taskEntity
     * @return TaskEntity
     */
    public function create(TaskEntity $taskEntity): TaskEntity
    {
        $mapper = $this->dataMapper->create($taskEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, TaskEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param TaskEntity $taskEntity
     * @param int $id
     * @return bool
     */
    public function delete(TaskEntity $taskEntity, int $id): bool
    {
        return $this->dataMapper->delete($taskEntity, $id);
    }

    /**
     * @param TaskEntity $taskEntity
     * @param int $id
     * @return TaskEntity
     */
    public function update(TaskEntity $taskEntity, int $id): TaskEntity
    {
        $mapper = $this->dataMapper->update($taskEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, TaskEntity::class);
        return $mapper->fetch();
    }
}