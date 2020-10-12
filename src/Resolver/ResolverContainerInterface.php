<?php

namespace Seeren\Container\Resolver;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionMethod;

/**
 * Interface to represent a resolver container
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Container\Resolver
 */
interface ResolverContainerInterface extends ContainerInterface
{

    /**
     * Resolve service arguments
     *
     * @param ReflectionMethod $constructor
     * @return array
     *
     * @throws NotFoundExceptionInterface No parameter was found for constructor identifier
     */
    public function resolve(ReflectionMethod $constructor): array;

}
