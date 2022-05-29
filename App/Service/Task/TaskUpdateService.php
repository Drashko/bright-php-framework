<?php
declare(strict_types=1);

namespace App\Service\Task;

use App\Entity\TaskEntity;
use App\Repository\Task\TaskRepositoryInterface;
use Exception;
use src\Utility\Sanitizer;

class TaskUpdateService implements TaskUpdateServiceInterface
{

    private TaskEntity $taskEntity;

    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskEntity $taskEntity, TaskRepositoryInterface $taskRepository)
    {
        $this->taskEntity = $taskEntity;
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function update(array $data, string $id): mixed
    {
        $sanitized = Sanitizer::clean($data);
        if(!empty($sanitized)){
            $time = $sanitized['time'];
            $taskTime = date("h:i:s", strtotime($time));
            $task = $this->taskEntity
                ->setName($sanitized['name'])
                ->setUserId((int)$sanitized['user_id'])
                ->setProjectId((int)$sanitized['project_id'])
                ->setText($sanitized['text'])
                ->setTime($taskTime)
                ->setStatus((int) $sanitized['status'])
                ->setCreatedAt(date("Y-m-d H:i:s"));
            return $this->taskRepository->update($task, (int) $id);
        }
    }
}