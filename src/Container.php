<?php

namespace Seeren\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use Seeren\Container\Parser\ParserContainer;
use Seeren\Container\Resolver\ResolverContainer;

/**
 * Class to represent a container
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Container
 */
class Container implements ContainerInterface
{

    /**
     * @var array
     */
    private array $services = [];

    /**
     * @var ResolverContainer
     */
    private ResolverContainer $resolver;

    /**
     * @param string|null $filename
     *
     * @throws ContainerException|NotFoundException for invalid configuration file
     */
    public function __construct(string $filename = null)
    {
        $this->resolver = new ResolverContainer();
        $filename = $filename ?? dirname(__FILE__, 6)
            . DIRECTORY_SEPARATOR
            . 'config'
            . DIRECTORY_SEPARATOR
            . 'services.json';
        if (is_file($filename)) {
            new ParserContainer($filename, $this->services);
        }
    }

    /**
     * {@inheritDoc}
     * @see \Psr\Container\ContainerInterface::get()
     */
    public final function get($id): object
    {
        try {
            return !$this->has($id)
                ? $this->services[$id] = $this->resolver->get($id, $this->services)
                : $this->services[$id];
        } catch (NotFoundExceptionInterface $e) {
            throw $e;
        } catch (ContainerExceptionInterface $e) {
            throw $e;
        }
    }

    /**
     * {@inheritDoc}
     * @see \Psr\Container\ContainerInterface::has()
     */
    public final function has($id): bool
    {
        return array_key_exists($id, $this->services) && is_object($this->services[$id]);
    }

}
