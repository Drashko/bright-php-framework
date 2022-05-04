<?php

namespace App\Validation;

use App\Repository\User\UserEmailRepositoryInterface;
use App\Service\User\UserFindEmailService;
use src\Factory\SessionFactory;
use src\Utility\Validator;

class LoginValidation
{
    private ?array $error = null;

    private UserEmailRepositoryInterface $userEmailRepository;

    private \src\Session\Session $session;

    public function __construct(UserEmailRepositoryInterface $userEmailRepository){
        $this->userEmailRepository = $userEmailRepository;
        $this->session   = SessionFactory::make();
    }

    /**
     * @param array $data
     * @return array|null
     */
    public function validate(array $data): ?array
    {
        if(!empty($data['email']))
            if(!Validator::email($data['email'])){
                $this->error[] = 'Please enter a valid email address!';
        }
        //if not an email has been found
        if(empty($this->userEmailRepository->find($data['email']))){
            $this->error[] = 'Wrong email or password!';
        }
        if($this->userEmailRepository->find($data['email'])) {
            $userEntity = $this->userEmailRepository->find($data['email']);
            if (!password_verify($data['password'], $userEntity->getPassword())) {
                $this->error[] = 'Wrong email or password!';
            }
            session_regenerate_id(true);
            $this->session->set('userId', $userEntity->getId());
        }
        return $this->error;
    }


}