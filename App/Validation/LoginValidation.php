<?php

namespace App\Validation;

use App\Entity\UserSessionEntity;
use App\Repository\User\UserEmailRepositoryInterface;
use App\Repository\UserSession\UserSessionRepositoryInterface;
use App\Service\User\UserFindEmailService;
use src\Config\Config;
use src\Cookie\CookieInterface;
use src\Factory\ConfigFactory;
use src\Factory\SessionFactory;
use src\Utility\Validator;

class LoginValidation
{
    private ?array $error = null;

    private UserEmailRepositoryInterface $userEmailRepository;

    private \src\Session\Session $session;

    private UserSessionRepositoryInterface $userSessionRepository;

    private UserSessionEntity $userSessionEntity;

    private CookieInterface $cookie;


    public function __construct(UserEmailRepositoryInterface $userEmailRepository, UserSessionRepositoryInterface $userSessionRepository, UserSessionEntity $userSessionEntity, CookieInterface $cookie){
        $this->userEmailRepository = $userEmailRepository;
        $this->userSessionRepository = $userSessionRepository;
        $this->userSessionEntity = $userSessionEntity;
        $this->cookie = $cookie;
        $this->session   = SessionFactory::make();
    }

    /**
     * @param array $data
     * @return array|null
     */
    public function login(array $data): ?array
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
            //remove old session id and set new one
            session_regenerate_id(true);
            //set user session id
            $this->session->set('userId', $userEntity->getId());

        }
        return $this->error;
    }

}