<?php

namespace App\Service\Permission;

use App\Entity\PermissionEntity;
use App\Service\Contract\FindByNameServiceInterface;
use PDO;
use src\DataMapper\DataMapperInterface;

class FindByNameService implements FindByNameServiceInterface
{

    private DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param string $name
     * @return bool|PermissionEntity
     */
    public function findByName(string $name): bool | PermissionEntity
    {
        $mapper = $this->dataMapper->findOneBy('`permission`', 'name' , $name);
        $mapper->setFetchMode(PDO::FETCH_CLASS, PermissionEntity::class);
        return $mapper->fetch();
    }
}