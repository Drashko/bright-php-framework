<?php

namespace App\Service\Role;

use App\Entity\RoleEntity;
use App\Repository\Role\RoleRepositoryInterface;
use App\Validation\RoleValidation;
use src\Utility\Sanitizer;

class RoleCreateService implements RoleCreateServiceInterface
{

    private RoleEntity $roleEntity;

    private RoleRepositoryInterface $roleRepository;
    private RoleValidation $validation;

    public function __construct(RoleEntity $roleEntity, RoleRepositoryInterface $roleRepository, RoleValidation $validation)
    {
        $this->roleEntity       = $roleEntity;
        $this->roleRepository   = $roleRepository;
        $this->validation       = $validation;
    }

    /**
     * @param array $data
     * @return array|null
     * @throws \Exception
     */
    public function create(array $data): array|null
    {
        $validate['errors'] = $this->validation->validate($data);
        //if errors return them to the use
        if(!empty($validate['errors'])){
            return $validate;
        }else{
            //sanitize data
            $sanitized = Sanitizer::clean($data);
            if(!empty($sanitized)){
                $role = $this->roleEntity
                    ->setName($sanitized['name'])
                    ->setCreatedAt(date('Y-m-d h:s:i'))
                    ->setUpdatedAt(date('Y-m-d h:s:i'));
                $this->roleRepository->create($role);
                //dispatch an event calling EventDispatcherInterface
                //$this->eventDispatcher->dispatch(Event::ROLE_CREATED);
                return null;
            }
        }
    }
}