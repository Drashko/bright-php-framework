<?php

namespace src\EventMF\Event;

use src\EventMF\Event;

class PreCreateEvent extends Event
{

    /**
     * @var object
     */
    private object $object;

    /**
     * PreCreateEvent constructor.
     * @param object $object
     */
    public function __construct(object $object)
    {
        $this->object = $object;
    }

    /**
     * @return object
     */
    public function getObject(): object
    {
        return $this->object;
    }

}