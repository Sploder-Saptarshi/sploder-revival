<?php

/**
 * The bootstrap file creates and returns the container.
 */

namespace SploderRevival\App;

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

    public static function get(): ContainerInterface
    {
        if (ContainerBuilder::$value !== null) {
            return ContainerBuilder::$value;
        }

        $containerBuilder = new DI\ContainerBuilder();
        $containerBuilder->addDefinitions(__DIR__ . '/config.php');
        ContainerBuilder::$value = $containerBuilder->build();
        return ContainerBuilder::$value;
    }
}
