<?php

namespace App\Service\Git;

use App\Entity\GitEntity;

interface GitCreateServiceInterface
{
    public function create(array $data) : GitEntity | null;

}