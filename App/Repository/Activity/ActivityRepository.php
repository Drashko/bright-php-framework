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
    public function delete(ActivityEntity $activityEntity, int $id): bool
    {
        return $this->dataMapper->delete($activityEntity, $id);
    }

    /**
     * @param ActivityEntity $activityEntity
     * @param int $id
     * @return ActivityEntity
     */
    public function update(ActivityEntity $activityEntity, int $id): ActivityEntity
    {
        $mapper = $this->dataMapper->update($activityEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ActivityEntity::class);
        return $mapper->fetch();
    }
}