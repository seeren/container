<?php

namespace Seeren\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

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
     * @throws Throwable Error while calling the callable
     */
    public function call(string $id, string $action, array $arguments = []): mixed;

}
