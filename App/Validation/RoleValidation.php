<?php

namespace App\Validation;

use App\Service\Contract\FindByNameServiceInterface;

class RoleValidation
{
    private ?array $error = null;

    private FindByNameServiceInterface $findByNameService;

    public function __construct(FindByNameServiceInterface $findByNameService)
    {
          $this->findByNameService = $findByNameService;
    }

    public function validate($data): ?array
    {
        if(empty($data['name'])){
            $this->error[] = 'Please enter Role name!';
        }
        if($this->findByNameService->findByName($data['name'])){
            $this->error[] = 'The name already exist ,please choose new one!';
        }
        return $this->error;
    }
}