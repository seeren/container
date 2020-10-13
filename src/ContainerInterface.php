<?php

namespace Seeren\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

/**
 * Interface to represent a container
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Container
 */
interface ContainerInterface extends \Psr\Container\ContainerInterface
{

    /**
     * Call an entry action of the container and returns it return value
     *
     * @param string $id Identifier of the entry to look for.
     * @param string $action The entry public callable
     * @param array $arguments The callable arguments
     * @return mixed Entry action return value
     *
     * @throws NotFoundExceptionInterface No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry
     * @throws Throwable Error will calling the callable
     */
    public function call(string $id, string $action, array $arguments = []);

}
