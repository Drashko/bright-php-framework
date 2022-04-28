<?php

namespace App\Validation;


class RoleUpdateValidation
{
    private ?array $error = null;

    public function validate($data): ?array
    {
        if(empty($data['name'])){
            $this->error[] = 'Please enter Role name!';
        }
        return $this->error;
    }
}