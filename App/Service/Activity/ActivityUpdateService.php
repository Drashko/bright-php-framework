<?php
declare(strict_types=1);

namespace App\Service\Activity;

use App\Entity\ActivityEntity;
use App\Repository\Activity\ActivityRepository;
use App\Repository\Activity\ActivityRepositoryInterface;
use src\Utility\Sanitizer;

class ActivityUpdateService implements ActivityUpdateServiceInterface
{


    private ActivityEntity $activityEntity;

    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityEntity $activityEntity, ActivityRepositoryInterface $activityRepository)
    {
         $this->activityEntity = $activityEntity;
         $this->activityRepository = $activityRepository;
    }

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     * @throws \Exception
     */
    public function update(array $data, string $id): mixed
    {
        $sanitized = Sanitizer::clean($data);
        if(!empty($sanitized)){
            $time = $sanitized['time'];
            $activityTime = date("h:i:s", strtotime($time));
            $task = $this->activityEntity
                ->setName($sanitized['name'])
                ->setUserId((int)$sanitized['user_id'])
                ->setProjectId((int)$sanitized['project_id'])
                ->setTaskId((int)$sanitized['task_id'])
                ->setDescription($sanitized['description'])
                ->setTime($activityTime)
                ->setStatus((int) $sanitized['status'])
                ->setCreatedAt(date("Y-m-d H:i:s"));
            return $this->activityRepository->update($task,  $id);
        }
    }

}