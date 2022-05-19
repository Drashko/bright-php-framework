<?php

namespace App\Repository\Task;

use App\Entity\TaskEntity;

interface TaskRepositoryInterface
{
    public function find($id) : TaskEntity;
    public function list(array $conditions) : array;
    public function create(TaskEntity $taskEntity) : TaskEntity;
    public function delete(TaskEntity $taskEntity, int $id) : bool;
    public function update(TaskEntity $taskEntity, int $id) : TaskEntity;
}