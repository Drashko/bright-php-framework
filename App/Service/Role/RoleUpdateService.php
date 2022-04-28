<?php

namespace App\Service\Role;

use App\Entity\RoleEntity;
use App\Repository\Role\RoleRepositoryInterface;
use App\Validation\RoleUpdateValidation;
use Exception;
use src\Utility\Sanitizer;

class RoleUpdateService implements RoleUpdateServiceInterface
{


    private RoleEntity $roleEntity;

    private RoleUpdateValidation $validation;

    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleEntity $roleEntity, RoleRepositoryInterface $roleRepository, RoleUpdateValidation $validation){
        $this->roleEntity = $roleEntity;
        $this->roleRepository = $roleRepository;
        $this->validation = $validation;
    }

    /**
     * @param array $data
     * @param string $id
     * @return array|RoleEntity
     * @throws Exception
     */
    public function update( array $data, string $id): array | RoleEntity
    {
        $data['errors'] = $this->validation->validate($data);
        //if errors return them to the user
        if (!empty($data['errors'])) {
            return $data;
       } else {
            $sanitized = Sanitizer::clean($data);
            if(!empty($sanitized)){
                $role = $this->roleEntity
                    ->setName($sanitized['name'])
                    ->setUpdatedAt(date('Y-m-d h:s:i'));
                $data['data'] = $this->roleRepository->update($role, $id);
                return $data;
            }
       }
    }
}