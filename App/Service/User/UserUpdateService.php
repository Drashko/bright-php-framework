<?php

namespace App\Service\User;

use App\Entity\UserEntity;
use App\Repository\User\UserUpdateRepositoryInterface;
use App\Validation\UserValidation;
use src\Utility\Sanitizer;

class UserUpdateService implements UserUpdateServiceInterface
{
    private UserUpdateRepositoryInterface $userRepository;

    private UserEntity $entity;

    private UserValidation $validation;

    public function __construct(UserEntity $entity, UserUpdateRepositoryInterface $userRepository, UserValidation $validation)
    {
        $this->userRepository = $userRepository;
        $this->entity = $entity;
        $this->validation = $validation;
    }

    /**
     * @param string $id
     * @param array $data
     * @return array| UserEntity
     * @throws \Exception
     */
    public function update(string $id, array $data): array | UserEntity
    {
        $data['errors'] = $this->validation->validate($data,$id);
        //if errors return them to the user
        if (!empty($data['errors'])) {
            return $data;
        } else {
            $sanitized = Sanitizer::clean($data);
            if ($sanitized) {
                $user = $this->entity
                    ->setRoleId($sanitized['role_id'])
                    ->setName($sanitized['name'])
                    ->setEmail($sanitized['email'])
                    ->setAddress($sanitized['address'])
                    ->setPhone($sanitized['phone'])
                    ->setStatus($sanitized['status'])
                    ->setUpdatedAt(date('Y-m-d h:s:i'));

                $data['data'] = $this->userRepository->update($user, $id);
                return $data;
            }
        }
    }
}