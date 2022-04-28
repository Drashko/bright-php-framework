<?php
$container = new \DI\ContainerBuilder();
$container->useAutowiring(true);
$container->useAnnotations(false);
$container->addDefinitions(require __DIR__ . '/dependencies.php');
return $container->build();



