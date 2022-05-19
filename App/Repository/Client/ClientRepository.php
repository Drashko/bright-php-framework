<?php
declare(strict_types=1);

namespace App\Repository\Client;

use App\Entity\ClientEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class ClientRepository implements ClientRepositoryInterface
{

    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param $id
     * @return ClientEntity
     */
    public function find($id): ClientEntity
    {
        $mapper = $this->dataMapper->findById('`client`', $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ClientEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function list(array $conditions): array
    {
        $mapper = $this->dataMapper->findAll('`client`', $conditions);
        return $this->dataMapper->fetchAllInto($mapper,ClientEntity::class);
    }

    /**
     * @param ClientEntity $clientEntity
     * @return ClientEntity
     */
    public function create(ClientEntity $clientEntity): ClientEntity
    {
        $mapper = $this->dataMapper->create($clientEntity);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ClientEntity::class);
        return $mapper->fetch();
    }

    /**
     * @param ClientEntity $clientEntity
     * @param int $id
     * @return bool
     */
    public function delete(ClientEntity $clientEntity, int $id): bool
    {
        return $this->dataMapper->delete($clientEntity, $id);
    }

    /**
     * @param ClientEntity $clientEntity
     * @param int $id
     * @return ClientEntity
     */
    public function update(ClientEntity $clientEntity, int $id): ClientEntity
    {
        $mapper = $this->dataMapper->update($clientEntity, $id);
        $mapper->setFetchMode(PDO::FETCH_CLASS, ClientEntity::class);
        return $mapper->fetch();
    }
}