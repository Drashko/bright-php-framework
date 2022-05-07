<?php

namespace App\Repository\UserSession;

use App\Entity\UserSessionEntity;

interface UserSessionRepositoryInterface
{
     public function findByUserId($user_id) : bool | UserSessionEntity;
     public function findByHash($hash) : bool | UserSessionEntity;
     public function create(UserSessionEntity $userSessionEntity) : UserSessionEntity;
}