<?php

namespace App\Repository\User;

use App\Entity\UserEntity;
use src\DataMapper\DataMapper;

class UserEmailRepository implements UserEmailRepositoryInterface
{
    public DataMapper $dataMapper;

    /**
     * @param DataMapper $dataMapper
     */
    public function __construct( DataMapper $dataMapper){
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param string $email
     * @return array
     */
    public function find(string $email): array
    {
        $user = $this->dataMapper->findOneBy('`users`', 'email' , $email);
        return $user->fetchAllInto(UserEntity::class);


    }
}