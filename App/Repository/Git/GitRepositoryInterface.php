<?php

namespace App\Repository\Git;

use App\Entity\GitEntity;

interface GitRepositoryInterface
{
    public function find($id) : GitEntity;
    public function list(array $conditions) : array;
    public function create(GitEntity $gitEntity) : GitEntity;
    public function delete(GitEntity $gitEntity, int $id) : bool;
    public function update(GitEntity $gitEntity, int $id) : GitEntity;
}