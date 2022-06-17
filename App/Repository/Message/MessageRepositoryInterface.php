<?php

namespace App\Repository\Message;

use App\Entity\MessageEntity;

interface MessageRepositoryInterface
{
    public function find($id) : MessageEntity;
    public function list(array $conditions) : array;
    public function create(MessageEntity $messageEntity) : MessageEntity;
    public function delete(MessageEntity $messageEntity, int $id) : bool;
    public function update(MessageEntity $messageEntity, int $id) : MessageEntity;
}