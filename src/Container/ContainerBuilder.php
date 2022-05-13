<?php

namespace src\Container;

use DI\Container;
use Exception;

class ContainerBuilder
{
    private Container $container;
    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->container = $this->getDependencies();
    }

    /**
     * @return Container
     * @throws Exception
     */
    public function getDependencies(): Container
    {
        $container = new \DI\ContainerBuilder();
        $container->useAutowiring(true);
        $container->useAnnotations(false);
        $container->addDefinitions(require ROOT_PATH . '/App/Config/dependencies.php');
        return $container->build();
    }

    public function init(): Container
    {
        return $this->container;
    }
}