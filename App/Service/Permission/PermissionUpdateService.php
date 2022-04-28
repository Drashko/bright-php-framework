<?php

namespace App\Service\Permission;

use App\Entity\PermissionEntity;
use App\Repository\Permission\PermissionRepositoryInterface;
use App\Validation\PermissionValidation;
use src\Utility\Sanitizer;

class PermissionUpdateService implements PermissionUpdateServiceInterface
{

    private PermissionEntity $permissionEntity;

    private PermissionRepositoryInterface $permissionRepository;

    private PermissionValidation $validation;

    public function __construct(PermissionEntity $permissionEntity, PermissionRepositoryInterface $permissionRepository, PermissionValidation $validation)
    {
        $this->permissionEntity = $permissionEntity;
        $this->permissionRepository = $permissionRepository;
        $this->validation = $validation;
    }

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     * @throws \Exception
     */
    public function update(array $data, string $id): mixed
    {
        $data['errors'] = $this->validation->validate($data);
        //if errors return them to the user
        if (!empty($data['errors'])) {
            return $data;
        } else {
            $sanitized = Sanitizer::clean($data);
            if(!empty($sanitized)){
                $role = $this->permissionEntity
                    ->setName($sanitized['name'])
                    ->setCode($sanitized['code'])
                    ->setDescription($sanitized['description'])
                    ->setUpdatedAt(date('Y-m-d h:s:i'));
                $data['data'] = $this->permissionRepository->update($role, $id);
                return $data;
            }
        }
    }
}