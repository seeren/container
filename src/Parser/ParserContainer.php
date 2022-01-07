<?php

namespace Seeren\Container\Parser;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use stdClass;

class ParserContainer implements ParserContainerInterface
{

    private stdClass $configuration;

    /**
     * @param string $filename
     * @param $services
     *
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function __construct(string $filename, &$services)
    {
        $this->parse($filename, $services);
    }

    public final function get(string $id)
    {
        if ($this->has($id)) {
            return $this->configuration->parameters->{$id};
        }
        throw new NotFoundException('Container parameter "' . $id . '" Not Found');
    }

    public final function has(string $id): bool
    {
        return property_exists($this->configuration->parameters, $id);
    }

    public final function parse(string $filename, array &$services = []): stdClass
    {
        if (!is_file($filename)
            || !($configuration = json_decode(file_get_contents($filename)))
            || !property_exists($configuration, 'parameters')
            || !property_exists($configuration, 'services')) {
            throw new ContainerException('Invalid "' . $filename . '" configuration file');
        }
        $this->configuration = $configuration;
        foreach ($this->configuration->services as $id => $service) {
            $services[$id] = [];
            foreach ($service as $paramName => $paramValue) {
                $services[$id][$paramName] = str_starts_with($paramValue, ':')
                    ? $this->get(substr($paramValue, 1))
                    : $paramValue;
            }
        }
        return $this->configuration;
    }

}
