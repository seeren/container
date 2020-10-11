<?php

namespace Seeren\Container\Resolver;

use ReflectionClass;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use Throwable;

/**
 * Class to represent a resolver container
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Container\Resolver
 */
class ResolverContainer implements ResolverContainerInterface
{

    /**
     * {@inheritDoc}
     * @see \Psr\Container\ContainerInterface::get()
     */
    public final function get($id, array &$services = null)
    {
        try {
            $reflection = new ReflectionClass($id);
            if (!($constructor = $reflection->getConstructor())) {
                return $reflection->newInstance();
            }
            $arguments = [];
            foreach ($constructor->getParameters() as $parameter) {
                $parameterName = $parameter->getName();
                if (($type = $parameter->getType()) && !$type->isBuiltin()) {
                    $typeName = $type->getName();
                    $arguments[] = $services[$typeName] ?? $this->get($typeName, $services);
                } else if (array_key_exists($id, $services) && array_key_exists($parameterName, $services[$id])) {
                    $arguments[] = $services[$id][$parameterName];
                } else {
                    throw new NotFoundException('Service "' . $id . '" parameter "' . $parameterName . '" Not Found');
                }
            }
            return $services[$id] = $reflection->newInstanceArgs($arguments);
        } catch (NotFoundException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new ContainerException($e->getMessage());
        }
    }

    /**
     * {@inheritDoc}
     * @see \Psr\Container\ContainerInterface::has()
     */
    public final function has($id): bool
    {
        return false;
    }

}
