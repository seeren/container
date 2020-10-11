<?php

namespace Seeren\Container\Parser;

use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use Throwable;

/**
 * Class to represent a parser container
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Container\Parser
 */
class ParserContainer implements ParserContainerInterface
{

    /**
     * @var \stdClass
     */
    private \stdClass $configuration;

    /**
     * @param string $filename
     * @param $services
     *
     * @throws NotFoundException|ContainerException
     */
    public function __construct(string $filename, &$services)
    {
        if (!($configuration = json_decode(file_get_contents($filename)))
            || !$configuration->parameters
            || !$configuration->services) {
            throw new ContainerException('Invalid configuration file: "' . $filename . '"');
        }
        $this->configuration = $configuration;
        foreach ($this->configuration->services as $id => $service) {
            $services[$id] = [];
            foreach ($service as $paramName => $paramValue) {
                $services[$id][$paramName] = ':' === substr($paramValue, 0, 1)
                    ? $this->get(substr($paramValue, 1))
                    : $paramValue;
            }
        }
    }

    /**
     * {@inheritDoc}
     * @throws NotFoundException|ContainerException
     * @see \Psr\Container\ContainerInterface::get()
     */
    public final function get($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException('Container parameter "' . $id . '" Not Found');
        }
        try {
            return $this->configuration->parameters->{$id};
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
        return property_exists($this->configuration->parameters, $id);
    }

}
