<?php

namespace App\Service\User;

use App\Entity\UserEntity;
use App\Repository\User\UserCreateRepositoryInterface;
use App\Validation\UserCreateValidation;
use Exception;
use src\Utility\Sanitizer;

class UserCreateService implements UserCreateServiceInterface
{

    private UserEntity $entity;

    private UserCreateValidation $validation;

    private UserCreateRepositoryInterface $userCreateRepository;

    public function __construct(UserEntity $entity, UserCreateRepositoryInterface $userCreateRepository, UserCreateValidation $validation)
    {
        $this->userCreateRepository = $userCreateRepository;
        $this->entity = $entity;
        $this->validation = $validation;
    }

    /**
     * @param array $data
     * @return array|null
     * @throws Exception
     */
    public function create(array $data): array | null
    {
        $validate['errors'] = $this->validation->validate($data);
        //if errors return them to the use
        if(!empty($validate['errors'])){
            return $validate;
        }else{
            //sanitize data
            $sanitized = Sanitizer::clean($data);
            //To do - move to separate class - PasswordHashing()
            if($sanitized){
                $passwordHash = password_hash($sanitized['password'], PASSWORD_BCRYPT);
                $user = $this->entity
                    ->setRoleId($sanitized['role_id'])//by default Client
                    ->setName($sanitized['name'])
                    ->setPassword($passwordHash)
                    ->setEmail($sanitized['email'])
                    ->setAddress($sanitized['address'])
                    ->setPhone($sanitized['phone'])
                    ->setStatus('pending')//update to 'active' on account confirmation
                    ->setCreatedAt(date('Y-m-d h:s:i'));
                $this->userCreateRepository->create($user);
                //dispatch an event calling EventDispatcherInterface
                //$this->eventDispatcher->dispatch(Event::USER_CREATED);
                return null;
            }
        }

    }
}