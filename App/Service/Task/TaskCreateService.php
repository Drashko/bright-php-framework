<?php
declare(strict_types=1);

namespace App\Service\Task;

use App\Entity\TaskEntity;
use App\Repository\Task\TaskRepositoryInterface;
use Exception;
use src\Utility\Sanitizer;

class TaskCreateService implements TaskCreateServiceInterface
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
     * @return TaskEntity|null
     * @throws Exception
     */
    public function create(array $data): TaskEntity|null
    {
        $sanitized = Sanitizer::clean($data);
        if(!empty($sanitized)){
            $task = $this->taskEntity
                ->setName($sanitized['name'])
                ->setUserId((int) $sanitized['user_id'])
                ->setProjectId((int) $sanitized['project_id'])
                ->setText($sanitized['text'])
                ->setTime($sanitized['time'])
                ->setStatus((int) $sanitized['status'])
                ->setCreatedAt(date("Y-m-d H:i:s"));
            return $this->taskRepository->create($task);
        }
        return null;
    }
}