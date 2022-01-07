<?php

namespace Seeren\Container\Resolver;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionMethod;

interface ResolverContainerInterface extends ContainerInterface
{

    /**
     * Resolve service arguments
     *
     * @param ReflectionMethod $method
     * @return array
     *
     * @throws NotFoundExceptionInterface No parameter was found for constructor identifier
     */
    public function resolve(ReflectionMethod $method): array;

}
