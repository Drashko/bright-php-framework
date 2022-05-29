<?php

namespace App\Service\Activity;

use App\Entity\ActivityEntity;

interface ActivityCreateServiceInterface
{
    public function create(array $data) : ActivityEntity | null;
}