<?php

namespace App\Service\Permission;

use App\Entity\PermissionEntity;
use App\Service\Contract\FindByNameServiceInterface;
use src\DataMapper\DataMapper;

class FindByNameService implements FindByNameServiceInterface
{

    private DataMapper $dataMapper;

    public function __construct(DataMapper $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param string $name
     * @return array
     */
    public function findByName(string $name): array
    {
        $role = $this->dataMapper->findOneBy('`permission`', 'name' , $name);
        return $role->fetchAllInto(PermissionEntity::class);
    }
}