<?php

namespace App\EventSubscriber;

use src\EventDispatcher\EventSubscriberInterface;

/**
 * Another way to listen to events is via an event subscriber.
 * An event subscriber is a PHP class that's able to tell the dispatcher exactly which events it should subscribe to.
 * It implements the EventSubscriberInterface interface, which requires a single static method called getSubscribedEvents().
 *
 * This is very similar to a listener class, except that the class itself can tell the dispatcher which events it should listen to.
 * To register a subscriber with the dispatcher, use the addSubscriber() method:
 */

/**
 * $subscriber = new StoreSubscriber();
   $dispatcher->addSubscriber($subscriber);
 */

/**
 * The dispatcher will automatically register the subscriber for each event returned by the getSubscribedEvents() method.
 * This method returns an array indexed by event names and whose values are either the method name to call
 * or an array composed of the method name to call and a priority (a positive or negative integer that defaults to 0).
 */

/**
 * The example above shows how to register several listener methods for the same event in subscriber and also shows how
 * to pass the priority of each listener method. The higher the number, the earlier the method is called.
 */

/**
 * in some cases, it may make sense for a listener to prevent any other listeners from being called. In other words,
 * the listener needs to be able to tell the dispatcher to stop all propagation of the event to future listeners (i.e. to not notify any more listeners).
 * This can be accomplished from inside a listener via the stopPropagation() method:
 *
 * public function onSomeAction(OrderPlacedEvent $event){ //onStoreOrder
 *    //.......
      $event->stopPropagation();
  }
 */

/**
 * It is possible to detect if an event was stopped by using the isPropagationStopped() method which returns a boolean value:
 * $dispatcher->dispatch($event, 'foo.event');
   if ($event->isPropagationStopped()) {
   // ...
    }
 */

class ExampleSubscriber implements EventSubscriberInterface
{

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ExampleEvents::NAME => [
                ['onUserLoginPre', 10],
                ['onUserLoggedOutPost', -10],
            ],
            ExampleOrderPlacedEvent::NAME => 'onSomeAction',
        ];
    }

    public function onUserLoginPre(ExampleEvents $event)
    {
        // ...
    }

    public function onUserLoggedOutPost(ExampleEvents $event)
    {
        // ...
    }

    public function onSomeAction(ExampleOrderPlacedEvent $event)
    {
        // ...
    }
}