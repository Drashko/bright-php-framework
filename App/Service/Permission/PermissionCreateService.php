<?php

declare(strict_types=1);

namespace App\Service\Permission;

use App\Entity\PermissionEntity;
use App\Repository\Permission\PermissionRepositoryInterface;
use App\Validation\PermissionCreateValidation;
use Exception;
use src\Utility\Sanitizer;

class PermissionCreateService  implements PermissionCreateServiceInterface
{


    private PermissionEntity $permissionEntity;

    private PermissionRepositoryInterface $permissionRepository;

    private PermissionCreateValidation $validation;

    public function __construct(PermissionEntity $permissionEntity, PermissionRepositoryInterface $permissionRepository, PermissionCreateValidation $validation)
    {
        $this->permissionEntity = $permissionEntity;
        $this->permissionRepository = $permissionRepository;
        $this->validation = $validation;
    }

    /**
     * @param array $data
     * @return array|null
     * @throws Exception
     */
    public function create(array $data): array|null
    {
        $validate['errors'] = $this->validation->validate($data);
        //if errors return them to the use
        if (!empty($validate['errors'])) {
            return $validate;
        } else {
            //sanitize data
            $sanitized = Sanitizer::clean($data);
            if (!empty($sanitized)) {
                $role = $this->permissionEntity
                    ->setName($sanitized['name'])
                    ->setDescription($sanitized['description'])
                    ->setCreatedAt(date('Y-m-d h:s:i'))
                    ->setUpdatedAt(date('Y-m-d h:s:i'));
                $this->permissionRepository->create($role);
                //dispatch an event calling EventDispatcherInterface
                //$this->eventDispatcher->dispatch(Event::PERMISSION_CREATED);
                return null;
            }
        }
    }
}