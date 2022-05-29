<?php
declare(strict_types=1);

namespace App\Repository\Activity;

use App\Entity\ActivityEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class ActivityRepository implements ActivityRepositoryInterface
{
    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param $id
     * @return ActivityEntity
     */
    public function find($id): ActivityEntity
    {
        $mapper = $this->dataMapper->findById('`activity`', $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ActivityEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {
        $mapper = $this->dataMapper->findAll('`activity`', $conditions);
        return $this->dataMapper->fetchAllInto($mapper,ActivityEntity::class);
    }
    /**
     * get all tasks and relational users and clients
     *
     * @param array $conditions
     * @return array
     */
    public function listAll(array $conditions) : array {
        $condition = [];
        $parameter = [];
        $sql = "SELECT a.Id ,a.task_id, a.user_id, a.project_id, a.name, a.description, a.time, a.status, a.created_at,t.name AS taskName,  p.name AS projectName, u.name AS userName"
            . " FROM `activity` a"
            . " LEFT JOIN `project` p ON (a.project_id = p.Id)"
            . " LEFT JOIN `task` t ON (a.task_id = t.Id)"
            . " LEFT JOIN `users` u ON (a.user_id = u.Id)";
        //prepare conditions and params
        if(!empty($conditions['status'])){
            $condition[] = 'a.status = :status';
            $parameter[] = $conditions['status'];
        }
        if(!empty($conditions['task_id'])){
            $condition[] = 'a.task_id = :task_id';
            $parameter[] = $conditions['task_id'];
        }
        if(!empty($conditions['user_id'])){
            $condition[] = 'a.user_id = :user_id';
            $parameter[] = $conditions['user_id'];
        }
        if(!empty($conditions['project_id'])){
            $condition[] = 'a.project_id = :project_id';
            $parameter[] = $conditions['project_id'];
        }
        if ($condition) {
            $sql .= " WHERE ".implode(" AND ", $condition);
        }
        $stm = $this->dataMapper->raw($sql);
        $stm->execute($parameter);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @param ActivityEntity $activityEntity
     * @return ActivityEntity
     */
    public function create(ActivityEntity $activityEntity): ActivityEntity
    {
        $mapper = $this->dataMapper->create($activityEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ActivityEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param ActivityEntity $activityEntity
     * @param int $id
     * @return bool
     */
    public function delete(ActivityEntity $activityEntity, string $id): bool
    {
        return $this->dataMapper->delete($activityEntity, $id);
    }

    /**
     * @param ActivityEntity $activityEntity
     * @param int $id
     * @return ActivityEntity
     */
    public function update(ActivityEntity $activityEntity, string $id): ActivityEntity
    {
        $mapper = $this->dataMapper->update($activityEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ActivityEntity::class);
        return $mapper->fetch();
    }
}