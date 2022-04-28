<?php

namespace src\EventMF\LIstener;

use src\EventMF\Event\PreCreateEvent;
use App\Repository\UserCreateRepository;

class UserCreateRepositoryListener
{
    /**
     * @param PreCreateEvent $event
     */
    public function __invoke(PreCreateEvent $event): void
    {
        $object = $event->getObject();


        if ($object instanceof UserCreateRepository) {
            // do something
        }
    }
}