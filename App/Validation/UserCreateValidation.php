<?php

namespace App\Validation;

use App\Service\User\UserFindEmailService;
use src\Utility\Validator;

class UserCreateValidation
{
    private ?array $error = null;

    private UserFindEmailService $emailService;

    public function __construct(UserFindEmailService $emailService){
        $this->emailService = $emailService;
    }



    /**
     * @param $data
     * @return array|null
     */
    public function validate($data): ?array
    {
        //to do add min max length
        if(empty($data['name'])){
            $this->error[] = 'Please enter your name!';
        }
        if(!empty($data['email']))
            if(!Validator::email($data['email'])){
                $this->error[] = 'Please enter a valid email address!';
            }
        if($this->emailService->find($data['email'])){
            $this->error[] = 'The email address already exist!';
        }
        //add max length
        if(!Validator::min($data['password'], 6)){
            $this->error[] = 'Please enter at least six characters!';
        }
        if($data['password'] !== $data['password_confirm']){
            $this->error[] = 'Password does not match!';
        }

        if(Validator::assertLetters($data['password'])){
            $this->error[] = 'Password needs at least one latter!';
        }
        if(Validator::assertNumbers($data['password'])){
            $this->error[] = 'Password needs at least one number!';
        }
        return $this->error;
    }
}