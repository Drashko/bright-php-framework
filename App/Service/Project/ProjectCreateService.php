<?php
declare(strict_types=1);

namespace App\Service\Project;


use App\Entity\ProjectEntity;
use App\Repository\Project\ProjectRepositoryInterface;
use Exception;
use src\Utility\Sanitizer;

class ProjectCreateService implements ProjectCreateServiceInterface
{
    /**
     * @var ProjectEntity
     */
    private ProjectEntity $projectEntity;
    /**
     * @var ProjectRepositoryInterface
     */
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ProjectEntity $projectEntity, ProjectRepositoryInterface $projectRepository)
    {
        $this->projectEntity = $projectEntity;
        $this->projectRepository = $projectRepository;

    }

    /**
     * @param array $data
     * @return ProjectEntity|null
     * @throws Exception
     */
    public function create(array $data): ProjectEntity | null
    {
        //validate
        $sanitized = Sanitizer::clean($data);
        if(!empty($sanitized)){
            $project = $this->projectEntity
                ->setName($sanitized['name'])
                ->setDescription($sanitized['description'])
                ->setStatus($sanitized['status'])
                ->setCreatedAt(date("Y-m-d H:i:s"));
            return $this->projectRepository->create($project);
        }
        return null;
    }
}