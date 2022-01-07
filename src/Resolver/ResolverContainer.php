<?php

namespace Seeren\Container\Resolver;

use ReflectionClass;
use ReflectionMethod;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use Throwable;

class ResolverContainer implements ResolverContainerInterface
{

    public final function get($id, array &$services = []): object
    {
        try {
            $reflection = new ReflectionClass($id);
            if (!$reflection->isInstantiable()) {
                throw new NotFoundException('Service argument "' . $id . '" Not Found');
            }
            return $services[$id] = ($constructor = $reflection->getConstructor())
                ? $reflection->newInstanceArgs($this->resolve($constructor, $services))
                : $reflection->newInstance();
        } catch (NotFoundException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new ContainerException($e->getMessage());
        }
    }

    public final function has(string $id): bool
    {
        return false;
    }

    public final function resolve(ReflectionMethod $method, array &$services = [], array $arguments = []): array
    {
        $parameters = $method->getParameters();
        array_splice($parameters, 0, count($arguments));
        $id = $method->getDeclaringClass()->getName();
        foreach ($parameters as $parameter) {
            if (($type = $parameter->getType()) && !$type->isBuiltin()) {
                $typeName = $type->getName();
                $arguments[] = array_key_exists($id, $services)
                && is_array($services[$id])
                && array_key_exists($typeName, $services[$id])
                    ? $services[$services[$id][$typeName]] ?? $this->get($services[$id][$typeName], $services)
                    : $services[$typeName] ?? $this->get($typeName, $services);
            } else if (array_key_exists($id, $services) && array_key_exists($parameter->getName(), $services[$id])) {
                $arguments[] = $services[$id][$parameter->getName()];
            } else if (!$parameter->isOptional()) {
                throw new NotFoundException('Service "' . $id . '" parameter "' . $parameter->getName() . '" Not Found');
            }
        }
        return $arguments;
    }

}
