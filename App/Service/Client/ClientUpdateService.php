<?php
declare(strict_types=1);

namespace App\Service\Client;

use App\Entity\ClientEntity;
use App\Repository\Client\ClientRepositoryInterface;
use src\Utility\Sanitizer;

class ClientUpdateService implements ClientUpdateServiceInterface
{

    private ClientEntity $clientEntity;

    private ClientRepositoryInterface $clientRepository;


    public function __construct(ClientEntity $clientEntity, ClientRepositoryInterface $clientRepository)
    {
        $this->clientEntity = $clientEntity;
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     * @throws \Exception
     */
    public function update(array $data, string $id): mixed
    {
        $sanitized = Sanitizer::clean($data);
        if(!empty($sanitized)){
            $clientEntity = $this->clientEntity
                ->setName($sanitized['name'])
                ->setEmail($sanitized['email'])
                ->setPhone($sanitized['phone'])
                ->setVat($sanitized['vat'])
                ->setStatus($sanitized['status'])
                ->setUpdatedAt(date('Y-m-d H:i:s'));
            return $this->clientRepository->update($clientEntity, $id);
        }
    }
}