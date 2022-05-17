<?php

namespace App\Repository\Project;

use App\Entity\ProjectEntity;
use App\Entity\RoleEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class ProjectRepository implements ProjectRepositoryInterface
{

    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param $id
     * @return ProjectEntity
     */
    public function find($id): ProjectEntity
    {
        $mapper = $this->dataMapper->findById('`project`', $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ProjectEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {
        $mapper = $this->dataMapper->findAll('`project`', $conditions);
        return $this->dataMapper->fetchAllInto($mapper,ProjectEntity::class);
    }

    /**
     * @param ProjectEntity $projectEntity
     * @return ProjectEntity
     */
    public function create(ProjectEntity $projectEntity): ProjectEntity
    {
        $mapper = $this->dataMapper->create($projectEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ProjectEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param ProjectEntity $projectEntity
     * @param int $id
     * @return bool
     */
    public function delete(ProjectEntity $projectEntity, int $id): bool
    {
        return $this->dataMapper->delete($projectEntity, $id);
    }

    /**
     * @param ProjectEntity $projectEntity
     * @param int $id
     * @return ProjectEntity
     */
    public function update(ProjectEntity $projectEntity, int $id): ProjectEntity
    {
        $mapper = $this->dataMapper->update($projectEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ProjectEntity::class);
        return $mapper->fetch();
    }
}