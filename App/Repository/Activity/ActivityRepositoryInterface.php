<?php

namespace App\Repository\Activity;

use App\Entity\ActivityEntity;

interface ActivityRepositoryInterface
{
    public function find($id) : ActivityEntity;
    public function list(array $conditions) : array;
    public function create(ActivityEntity $activityEntity) : ActivityEntity;
    public function delete(ActivityEntity $activityEntity, int $id) : bool;
    public function update(ActivityEntity $activityEntity, int $id) : ActivityEntity;
}