<?php
/**
 * project root directory defined
 */
define('ROOT_PATH', realpath(dirname(__DIR__)));
/**
 * autoload classes
 */
$autoload = ROOT_PATH . '/vendor/autoload.php';
require_once ROOT_PATH . '/src/Helper/functions.php';
if(is_file($autoload)){
    require $autoload;
}
/**
 * include Application class
 */
use src\Application\Application;
use src\EventDispatcher\EventDispatcher;
use src\Event\Event;
use src\EventListener\UserRegisterListener;
use src\Event\UserRegisterEvent;
/**
 * Run the framework
 */
(new Application(ROOT_PATH))->run()->setSession()->setRouteHandler();
/**
 * TODO:
 * EVENTS - ON NOW
 * AUTHENTICATION ACCESS
 * CSRF - CROSS CITE REQUEST FORGERY
 * TESTS
 * REFACTORING
 */

/**
  Example of dispatchning event
  //the order is somehow created or retrieved
   $order = new Order();
 *
  //creates the OrderPlacedEvent and dispatches it
    $event = new OrderPlacedEvent($order);
 *
  $dispatcher->dispatch($event, OrderPlacedEvent::NAME);
*/