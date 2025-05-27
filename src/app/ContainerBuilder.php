<?php

/**
 * The bootstrap file creates and returns the container.
 * TODO: move this outside of the ./src repo for security
 */

namespace SploderRevival\app;

use DI;
use Psr\Container\ContainerInterface;

require __DIR__ . '/../vendor/autoload.php';

// We still need to do our own basic lazy loading of the container to prevent unecessarily
// constructing the container multiple times
class ContainerBuilder
{
    private function __construct()
    {
    }

    private static ContainerInterface|null $value = null;

    public static function getInstance(): ContainerInterface
    {
        if (ContainerBuilder::$value !== null) {
            return ContainerBuilder::$value;
        }

        $containerBuilder = new DI\ContainerBuilder();
        $containerBuilder->addDefinitions(__DIR__ . '/container_config.php');
        ContainerBuilder::$value = $containerBuilder->build();
        return ContainerBuilder::$value;
    }

    /**
    * Returns the instance with the type specified
    *
    * @template T
    * @param class-string<T> $class
    * @return T
    */
    public static function getAs(string $class): mixed
    {
        return ContainerBuilder::getInstance()->get($class);
    }

    public static function get(string $id): mixed
    {
        return ContainerBuilder::getInstance()->get($id);
    }
}
