<?php

namespace App\Repository\Message;

use App\Entity\MessageEntity;

interface MessageRepositoryInterface
{
    public function find($id) : MessageEntity;
    public function list(array $conditions) : array;
    public function create(MessageEntity $roleEntity) : MessageEntity;
    public function delete(MessageEntity $roleEntity, int $id) : bool;
    public function update(MessageEntity $roleEntity, int $id) : MessageEntity;
}