<?php

namespace App\Repository\User;

use App\Entity\UserEntity;
use PDO;
use src\DataMapper\DataMapperInterface;

class UserEmailRepository implements UserEmailRepositoryInterface
{
    public DataMapperInterface $dataMapper;

    /**
     * @param DataMapperInterface $dataMapper
     */
    public function __construct(DataMapperInterface $dataMapper){
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function find(string $email): mixed
    {
        $mapper = $this->dataMapper->findOneBy('`users`', 'email' , $email);
        $mapper->setFetchMode(PDO::FETCH_CLASS, UserEntity::class);
        return $mapper->fetch();


    }
}