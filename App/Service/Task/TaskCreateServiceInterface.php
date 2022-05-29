<?php

namespace App\Service\Task;

use App\Entity\TaskEntity;

interface TaskCreateServiceInterface
{
    public function create(array $data) : TaskEntity | null;
}