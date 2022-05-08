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
     * @param MessageEntity $roleEntity
     * @return MessageEntity
     */
    public function create(MessageEntity $roleEntity): MessageEntity
    {
        $mapper = $this->dataMapper->create($roleEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, MessageEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param MessageEntity $roleEntity
     * @param int $id
     * @return bool
     */
    public function delete(MessageEntity $roleEntity, int $id): bool
    {
        return $this->dataMapper->delete($roleEntity, $id);
    }

    /**
     * @param MessageEntity $roleEntity
     * @param int $id
     * @return MessageEntity
     */
    public function update(MessageEntity $roleEntity, int $id): MessageEntity
    {
        $mapper = $this->dataMapper->update($roleEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, MessageEntity::class);
        return $mapper->fetch();
    }
}