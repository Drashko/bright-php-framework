<?php

namespace App\Event;

//must extend EventInterface implementing its method
use src\EventDispatcher\StoppableEventInterface;

/**
 * example :
 *
 * class OrderPlacedEvent extends Event {
 *
    public const NAME = 'order.placed';

    protected $order;

    public function __construct(Order $order){
        $this->order = $order;
    }

    public function getOrder(): Order{
        return $this->order;
    }
 */

class Event implements StoppableEventInterface
{

    /**
     * @return bool
     */
    public function isPropagationStopped(): bool
    {
        // TODO: Implement isPropagationStopped() method.
    }
}