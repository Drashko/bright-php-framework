<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\UserEntity;
use App\Repository\User\UserCreateRepositoryInterface;
use App\Validation\RegisterValidation;
use Exception;
use src\Factory\SessionFactory;
use src\Utility\Sanitizer;
use src\Utility\Validator;

class UserRegisterService implements UserRegisterServiceInterface
{

    protected UserEntity $entity;

    private UserCreateRepositoryInterface $userRepository;

    private RegisterValidation $validation;

    private $session;

    //TO do inject EventDispatcherInterface
    public function __construct(UserEntity $entity, UserCreateRepositoryInterface $userRepository, RegisterValidation $validation){
       $this->userRepository = $userRepository;
       $this->entity = $entity;
       $this->validation = $validation;
       $this->session = SessionFactory::make();
   }

    /**
     * @param array $data
     * @return array|null
     * @throws Exception
     */
    public function register(array $data): array | null
    {
       $validate = $this->validation->validate($data);
       //if errors return them to the user
       if(!empty($validate)){
           return $validate;
       }else{
           //sanitize data
           $sanitized = Sanitizer::clean($data);
           //To do - move to separate class - PasswordHashing()
           $passwordHash = password_hash($sanitized['password'], PASSWORD_BCRYPT);
           if($sanitized){
               $user = $this->entity
                   ->setRoleId(1)//by default Client
                   ->setName($sanitized['name'])
                   ->setPassword($passwordHash)
                   ->setEmail($sanitized['email'])
                   ->setStatus('pending')//update to 'active' on account confirmation
                   ->setCreatedAt(date('Y-m-d h:s:i'));
               if($registeredUser = $this->userRepository->create($user)){
                   session_regenerate_id(true);
                   $this->session->set('userId', $registeredUser->getId());
                   //return $registeredUser;
               }

               //dispatch an event calling EventDispatcherInterface
               //$this->eventDispatcher->dispatch(Event::Register, )

               return null;
           }
       }
   }
}