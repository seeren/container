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
 * @version 1.1.3
 */

namespace Seeren\Container\Resolver\Constructor;

use Seeren\Container\Cache\CacheInterface;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use ReflectionClass;
use ReflectionParameter;
use ReflectionException;
use Throwable;

/**
 * Class for represent a constructor reflection resolver
 * 
 * @category Seeren
 * @package Container
 * @subpackage Resolver\Constructor
 * @abstract
 */
abstract class AbstractResolver
{

    /**
     * Get parameter argument
     *
     * @param ReflectionParameter $param
     * @param CacheInterface $cache
     * @return null|mixed
     *
     * @throws NotFoundException
     * @throws ContainerException
     */
    abstract protected function getArg(ReflectionParameter $param, CacheInterface $cache = null);

   protected function __construct()
   {
   }

   /**
    * Get reflexion class
    *
    * @param string $className
    * @return ReflectionClass
    *
    * @throws NotFoundException
    * @throws ContainerException
    */
   protected final function getReflection(string $className): ReflectionClass
   {
       try {
           $reflexion = new ReflectionClass($className);
       } catch (ReflectionException $e) {
           throw new NotFoundException(
               "Can't get reflection for " . $className . ": not found");
       }
       if (!$reflexion->isInstantiable()) {
           throw new ContainerException(
               "Can't get reflection for " . $className . ": not instanciable");
       }
       return $reflexion;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Container\Resolver\ResolverInterface::resolve()
    */
   public final function resolve(string $className, CacheInterface $cache = null)
   {
       try {
           if (null !== $cache && $cache->has($className)) {
               return $cache->get($className);
           }
           $reflexion = $this->getReflection($className);
           $args = [];
           if (($constructor = $reflexion->getConstructor())) {
               foreach ($constructor->getParameters() as $param) {
                   $args[] = $this->getArg($param, $cache);
               }
           }
           $instance = $reflexion->newInstanceArgs($args);
           if (null !== $cache) {
               $cache->set($className, $instance);
           }
           return $instance;
       } catch (NotFoundException $e) {
           throw new NotFoundException(
               "Can't resolve " . $className . ": " . $e->getMessage());
       } catch (Throwable $e) {
           throw new ContainerException(
               "Can't resolve " . $className . ": " . $e->getMessage());
       }
   }

}
