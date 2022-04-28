<?php
declare(strict_types=1);

namespace App\Service\User;

use App\Repository\User\UserEmailRepositoryInterface;

class UserFindEmailService
{
    /**
     * @var UserEmailRepositoryInterface
     */
    public UserEmailRepositoryInterface $userEmailRepository;

    /**
     * @param UserEmailRepositoryInterface $emailRepository
     */
    public function __construct(UserEmailRepositoryInterface $emailRepository){
        $this->userEmailRepository = $emailRepository;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function find(string $email): bool
    {
        if(count($this->userEmailRepository->find($email))){
            return true;
        }
        return false;
    }
}