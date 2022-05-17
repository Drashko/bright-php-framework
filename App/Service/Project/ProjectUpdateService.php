<?php

namespace App\Service\Project;

use App\Entity\ProjectEntity;
use App\Repository\Project\ProjectRepositoryInterface;
use Exception;
use src\Utility\Sanitizer;

class ProjectUpdateService implements ProjectUpdateServiceInterface
{

    private ProjectEntity $projectEntity;

    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ProjectEntity $projectEntity, ProjectRepositoryInterface $projectRepository)
    {
        $this->projectEntity = $projectEntity;
        $this->projectRepository = $projectRepository;
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
            $projectEntity = $this->projectEntity
                ->setName($sanitized['name'])
                ->setDescription($sanitized['description'])
                ->setUpdatedAt(date('Y-m-d H:i:s'));
            return $this->projectRepository->update($projectEntity, $id);
        }
    }
}