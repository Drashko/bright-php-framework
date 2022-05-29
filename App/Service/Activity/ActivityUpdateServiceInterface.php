<?php

namespace App\Service\Activity;

interface ActivityUpdateServiceInterface
{
    public function update( array $data, string $id) : mixed;

}