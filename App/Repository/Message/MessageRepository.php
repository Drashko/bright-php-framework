<?php

namespace App\Repository\Message;

use App\Entity\MessageEntity;
use App\Entity\RoleEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class MessageRepository implements MessageRepositoryInterface
{
    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {
        $mapper = $this->dataMapper->findAll('`message`', $conditions);
        return $this->dataMapper->fetchAllInto($mapper,MessageEntity::class);
    }

    /**
     * @param $id
     * @return MessageEntity
     */
    public function find($id): MessageEntity
    {
        $mapper = $this->dataMapper->findById('`message`', $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, MessageEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param MessageEntity $messageEntity
     * @return MessageEntity
     */
    public function create(MessageEntity $messageEntity): MessageEntity
    {
        $mapper = $this->dataMapper->create($messageEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, MessageEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param MessageEntity $messageEntity
     * @param int $id
     * @return bool
     */
    public function delete(MessageEntity $messageEntity, int $id): bool
    {
        return $this->dataMapper->delete($messageEntity, $id);
    }

    /**
     * @param MessageEntity $messageEntity
     * @param int $id
     * @return MessageEntity
     */
    public function update(MessageEntity $messageEntity, int $id): MessageEntity
    {
        $mapper = $this->dataMapper->update($messageEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, MessageEntity::class);
        return $mapper->fetch();
    }
}