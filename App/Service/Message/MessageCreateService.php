<?php

namespace App\Service\Message;

use App\Entity\MessageEntity;
use App\Repository\Message\MessageRepositoryInterface;
use App\Validation\MessageValidation;

class MessageCreateService implements MessageCreateServiceInterface
{
    /**
     * @var MessageEntity
     */
    private MessageEntity $messageEntity;
    /**
     * @var MessageRepositoryInterface
     */
    private MessageRepositoryInterface $messageRepository;
    /**
     * @var MessageValidation
     */
    private MessageValidation $validation;

    public function __construct(MessageEntity $messageEntity, MessageRepositoryInterface $messageRepository, MessageValidation $validation)
   {
        $this->messageEntity = $messageEntity;
        $this->messageRepository = $messageRepository;
        $this->validation = $validation;
   }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        pr($data);
        return [];
    }
}