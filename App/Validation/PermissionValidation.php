<?php

namespace App\Validation;

class PermissionValidation
{
    private ?array $error = null;

    public function validate($data): ?array
    {
        if(empty($data['name'])){
            $this->error[] = 'Please enter permission name!';
        }
        return $this->error;
    }
}