<?php

namespace App\Service\Project;

use App\Entity\ProjectEntity;

interface ProjectCreateServiceInterface
{
    public function create(array $data) : ProjectEntity | null;
}