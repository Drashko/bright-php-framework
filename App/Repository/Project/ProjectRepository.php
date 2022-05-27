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
    /*public function list(array $conditions): array
    {
        $mapper = $this->dataMapper->findAll('`project`', $conditions);
        return $this->dataMapper->fetchAllInto($mapper,ProjectEntity::class);
    }*/

    public function list(array $conditions) : array {
        $sql = "SELECT p.Id ,p.manager_id, p.client_id, p.name , p.description,   p.start_date, p.end_date, p.status, p.created_at,  c.name As clientName, u.name As managerName"
              . " FROM `project` p"
              . " LEFT JOIN `client` c ON (p.client_id = c.Id)"
              . " LEFT JOIN `users` u ON (p.manager_id = u.Id)";
        if(!empty($conditions['status'])){
            $sql .= " WHERE p.status = :status";
        }
        $stm = $this->dataMapper->raw($sql);
        if(!empty($conditions['status'])){
            $stm->execute(['status' => $conditions['status']]);
        }else{
            $stm->execute();
        }
        return $stm->fetchAll(PDO::FETCH_ASSOC);
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
     * @param string $id
     * @return bool
     */
    public function delete(ProjectEntity $projectEntity, string $id): bool
    {
        return $this->dataMapper->delete($projectEntity, $id);
    }

    /**
     * @param ProjectEntity $projectEntity
     * @param string $id
     * @return ProjectEntity
     */
    public function update(ProjectEntity $projectEntity, string $id): ProjectEntity
    {
        $mapper = $this->dataMapper->update($projectEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ProjectEntity::class);
        return $mapper->fetch();
    }
}