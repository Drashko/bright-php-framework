<?php

namespace App\Service\Role;

use App\Entity\RoleEntity;

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
        $role = $this->dataMapper->findOneBy('`role`', 'name' , $name);
        return $role->fetchAllInto(RoleEntity::class);

    }
}