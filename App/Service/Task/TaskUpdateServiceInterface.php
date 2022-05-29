<?php

namespace App\Service\Task;

interface TaskUpdateServiceInterface
{
    public function update( array $data, string $id) : mixed;
}