<?php
declare(strict_types=1);

namespace App\Service\Activity;

use App\Entity\ActivityEntity;
use App\Repository\Activity\ActivityRepositoryInterface;
use Exception;
use src\Utility\Sanitizer;

class ActivityCreateService implements ActivityCreateServiceInterface
{

    private ActivityEntity $activityEntity;

    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityEntity $activityEntity, ActivityRepositoryInterface $activityRepository)
    {
        $this->activityEntity     = $activityEntity;
        $this->activityRepository = $activityRepository;
    }

    /**
     * @param array $data
     * @return ActivityEntity|null
     * @throws Exception
     */
    public function create(array $data): ActivityEntity|null
    {
        $sanitized = Sanitizer::clean($data);
        if(!empty($sanitized)){
            $activity = $this->activityEntity
                ->setName($sanitized['name'])
                ->setUserId((int) $sanitized['user_id'])
                ->setProjectId((int) $sanitized['project_id'])
                ->setTaskId((int) $sanitized['task_id'])
                ->setTime($sanitized['time'])
                ->setDescription($sanitized['description'])
                ->setStatus((int) $sanitized['status'])
                ->setCreatedAt(date("Y-m-d H:i:s"));
            return $this->activityRepository->create($activity);
        }
        return null;
    }
}