<?php

namespace App\Repository\UserSession;

use App\Entity\UserSessionEntity;

interface UserSessionInterface
{
     public function findByUserId($id) : bool | UserSessionEntity;
     public function findByHash($hash) : string;
}