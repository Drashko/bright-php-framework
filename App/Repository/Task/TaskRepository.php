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
        $mapper = $this->dataMapper->findById('`task`', $id);
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
     * get all tasks and relational users and clients
     *
     * @param array $conditions
     * @return array
     */
    public function listAll(array $conditions) : array {
        $condition = [];
        $parameter = [];
        $sql = "SELECT t.Id ,t.user_id, t.project_id, t.name, t.text, t.time, t.status, t.created_at,  p.name As projectName, u.name As userName"
            . " FROM `task` t"
            . " LEFT JOIN `project` p ON (t.project_id = p.Id)"
            . " LEFT JOIN `users` u ON (t.user_id = u.Id)";
       //prepare conditions and params
       if(!empty($conditions['status'])){
           $condition[] = 't.status = :status';
           $parameter[] = $conditions['status'];
       }
        if(!empty($conditions['user_id'])){
            $condition[] = 't.user_id = :user_id';
            $parameter[] = $conditions['user_id'];
        }
        if(!empty($conditions['project_id'])){
            $condition[] = 't.project_id = :project_id';
            $parameter[] = $conditions['project_id'];
        }
        if ($condition) {
            $sql .= " WHERE ".implode(" AND ", $condition);
        }
        $stm = $this->dataMapper->raw($sql);
        $stm->execute($parameter);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
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