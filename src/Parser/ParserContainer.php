<?php

namespace Seeren\Container\Parser;

use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use stdClass;

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
     * @var stdClass
     */
    private stdClass $configuration;

    /**
     * @param string $filename
     * @param $services
     *
     * @throws NotFoundException|ContainerException
     */
    public function __construct(string $filename, &$services)
    {
        $this->parse($filename, $services);
    }

    /**
     * {@inheritDoc}
     * @throws NotFoundException|ContainerException
     * @see \Psr\Container\ContainerInterface::get()
     */
    public final function get($id)
    {
        if ($this->has($id)) {
            return $this->configuration->parameters->{$id};
        }
        throw new NotFoundException('Container parameter "' . $id . '" Not Found');
    }

    /**
     * {@inheritDoc}
     * @see \Psr\Container\ContainerInterface::has()
     */
    public final function has($id): bool
    {
        return property_exists($this->configuration->parameters, $id);
    }

    /**
     * {@inheritDoc}
     * @throws NotFoundException|ContainerException
     * @see ParserContainerInterface::parse()
     */
    public final function parse(string $filename, array &$services = []): stdClass
    {
        if (!is_file($filename)
            || !($configuration = json_decode(file_get_contents($filename)))
            || !property_exists($configuration, 'parameters')
            || !property_exists($configuration, 'services')) {
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
        return $this->configuration;
    }

}
