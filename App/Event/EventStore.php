<?php

namespace App\Event;
/**
 * Define all events which usage do not require separate 'EventClass' where no additional data needs to be passed to the dispatcher and other listeners
 */
class EventStore
{
     public const USER_REGISTERED = 'user.registered';
}