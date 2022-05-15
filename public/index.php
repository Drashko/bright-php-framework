<?php
session_start();
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
use DI\Container;
use src\Container\ContainerBuilder;
use App\Service\Auth\AuthenticateService;
use src\Application\Application;
use src\Utility\Globals;


//get current loggedIn user
$container = (new ContainerBuilder())->init();
$authenticate = $container->get(AuthenticateService::class);
$getLoggedInUser  = $authenticate->getLoggedInUser();
Globals::add('loggedInUser', $getLoggedInUser);


/**
 * Run the framework
 */
(new Application(ROOT_PATH))->run()->setRouteHandler();
//echo phpinfo();
//pr(BASE_URL);
//pr(INDEX_URL);







