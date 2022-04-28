<?php

namespace App\EventListener;

//to do implement PSR EventListenerInterface....
use App\Event\UserRegisterEvent;

/**
 * To take advantage of an existing event, you need to connect a listener to the dispatcher so that it can be notified when the event is dispatched.
 * A call to the dispatcher's addListener() method associates any valid PHP callable to an event:
 *
 * $listener = new AcmeListener();
   $dispatcher->addListener('acme.foo.action', [$listener, 'onFooAction']);
 *
 *
 * $dispatcher->addListener('acme.foo.action', function (Event $event) {
    // will be executed when the acme.foo.action event is dispatched
    });
 *
 *
 * Once a listener is registered with the dispatcher, it waits until the event is notified.
 * In the above example, when the acme.foo.action event is dispatched,
 * the dispatcher calls the AcmeListener::onFooAction() method and passes the Event object as the single argument:
 *
 * class AcmeListener{
    // ...
    public function onFooAction(Event $event){
    // ... do something
    }
    }
 *
 * The $event argument is the event object that was passed when dispatching the event.
 * In many cases, a special event subclass is passed with extra information.
 */



/**
 * Creating and Dispatching an Event
    In addition to registering listeners with existing events, you can create and dispatch your own events.
 * This is useful when creating third-party libraries and also when you want to keep different components of your own system flexible and decoupled.
 *
 *
 *
 * Suppose you want to create a new event - order.placed - that is dispatched each time a customer orders a product with your application.
 * When dispatching this event, you'll pass a custom event instance that has access to the placed order.
 * Start by creating this custom event class and documenting it:
 *
 * /**
 * The order.placed event is dispatched each time an order is created
 * in the system.
 */
   /** class OrderPlacedEvent extends Event
    {
        public const NAME = 'order.placed';

        protected $order;

        public function __construct(Order $order)
        {
            $this->order = $order;
        }

        public function getOrder(): Order
        {
            return $this->order;
        }
    }
    *
   Each listener now has access to the order via the getOrder() method.*/

class ExampleUserRegisterListener
{
    /**
     * listens for a new user registration event
     * @param UserRegisterEvent $event
     */
     public function onRegister(UserRegisterEvent $event){
         var_dump($event);
     }
}