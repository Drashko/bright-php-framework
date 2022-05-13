<?php

namespace App\Service\Message;


interface MessageCreateServiceInterface
{
    public function create(array $data) : array;
}