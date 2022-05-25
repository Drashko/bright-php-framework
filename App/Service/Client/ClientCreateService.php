<?php
declare(strict_types=1);

namespace App\Service\Client;

use App\Entity\ClientEntity;
use App\Repository\Client\ClientRepositoryInterface;
use src\Utility\Sanitizer;

class ClientCreateService implements ClientCreateServiceInterface
{
    /**
     * @var ClientEntity
     */
    private ClientEntity $clientEntity;
    /**
     * @var ClientRepositoryInterface
     */
    private ClientRepositoryInterface $clientRepository;

    public function __construct(ClientEntity $clientEntity, ClientRepositoryInterface $clientRepository)
    {
        $this->clientEntity = $clientEntity;
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param array $data
     * @return ClientEntity|null
     * @throws \Exception
     */
    public function create(array $data): ClientEntity|null
    {
        //validate
        $sanitized = Sanitizer::clean($data);
        if(!empty($sanitized)){
            $client = $this->clientEntity
                ->setName($sanitized['name'])
                //->setOwnerId($sanitized['owner_id'])
                ->setEmail($sanitized['email'])
                ->setPhone($sanitized['phone'])
                ->setVat($sanitized['vat'])
                ->setStatus($sanitized['status'])
                ->setCreatedAt(date("Y-m-d H:i:s"));
            return $this->clientRepository->create($client);
        }
        return null;
    }
}