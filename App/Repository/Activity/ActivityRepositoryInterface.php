<?php

namespace App\Repository\Activity;

use App\Entity\ActivityEntity;

interface ActivityRepositoryInterface
{
    public function find($id) : ActivityEntity;
    public function list(array $conditions) : array;
    public function create(ActivityEntity $activityEntity) : ActivityEntity;
    public function delete(ActivityEntity $activityEntity, string $id) : bool;
    public function update(ActivityEntity $activityEntity, string $id) : ActivityEntity;
}