<?php

namespace App\Validation;

use App\Service\User\UserFindEmailService;
use App\Service\User\UserFindIdServiceInterface;
use src\Utility\Validator;

class UserValidation
{
    private ?array $error = null;

    private UserFindEmailService $emailService;

    private UserFindIdServiceInterface $findIdService;

    public function __construct(UserFindEmailService $emailService, UserFindIdServiceInterface $findIdService)
    {
        $this->emailService = $emailService;
        $this->findIdService = $findIdService;
    }

    /**
     * @param $data
     * @return array|null
     */
    public function validate($data, $id): ?array
    {
        //to do add min - max length to name
        if(empty($data['name'])) {
            $this->error[] = 'Please enter your name!';
        }
        if(!empty($data['email'])){
            if (!Validator::email($data['email'])) {
                $this->error[] = 'Please enter a valid email address!';
            }
        }
        //search for record id in db
        if(!empty($this->findIdService->find($id))){
            $foundUser  = $this->findIdService->find($id);
            $email = $foundUser->getEmail();
            //compare with the post input
            if($email !== $data['email']){
                if($this->emailService->find($data['email'])){
                    $this->error[] = 'The email address already exist!';
                }
            }
        }
        return $this->error;
    }
}