<?php

namespace App\Service\Role;

use App\Entity\RoleEntity;

use App\Service\Contract\FindByNameServiceInterface;

use src\DataMapper\DataDataMapper;

class FindByNameService implements FindByNameServiceInterface
{


    private DataDataMapper $dataMapper;

    public function __construct(DataDataMapper $dataMapper)
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