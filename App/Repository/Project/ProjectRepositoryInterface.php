<?php

namespace App\Repository\Project;

use App\Entity\ProjectEntity;

interface  ProjectRepositoryInterface
{
    public function find($id) : ProjectEntity;
    public function list(array $conditions) : array;
    public function create(ProjectEntity $projectEntity) : ProjectEntity;
    public function delete(ProjectEntity $projectEntity, int $id) : bool;
    public function update(ProjectEntity $projectEntity, int $id) : ProjectEntity;
}