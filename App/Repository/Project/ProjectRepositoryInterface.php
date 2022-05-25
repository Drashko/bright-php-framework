<?php

namespace App\Repository\Project;

use App\Entity\ProjectEntity;

interface  ProjectRepositoryInterface
{
    public function find($id) : ProjectEntity;
    public function list(array $conditions) : array;
    public function create(ProjectEntity $projectEntity) : ProjectEntity;
    public function delete(ProjectEntity $projectEntity, string $id) : bool;
    public function update(ProjectEntity $projectEntity, string $id) : ProjectEntity;
}