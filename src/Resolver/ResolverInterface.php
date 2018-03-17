<?php

/**
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @author Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/container
 * @version 1.1.1
 */
namespace Seeren\Container\Resolver;

use Seeren\Container\Cache\CacheInterface;
use Seeren\Container\Exception\NotFoundException;
use Seeren\Container\Exception\ContainerException;

/**
 * Interface for represent a resolver
 *
 * @category Seeren
 * @package Container
 * @subpackage Resolver
 */
interface ResolverInterface
{

    /**
     * Resolve service
     *
     * @param string $className
     * @param CacheInterface $cache
     * @return mixed service
     *        
     * @throws NotFoundException
     * @throws ContainerException
     */
    public function resolve(string $className, CacheInterface $cache = null);
}
