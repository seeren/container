<?php

/**
 * This file contain Seeren\Container\Resolver\Constructor\AbstractResolver
 * class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.0.1
 */

namespace Seeren\Container\Resolver\Constructor;

use Seeren\Container\Cache\CacheInterface;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NoFoundException;
use ReflectionClass;
use ReflectionParameter;
use ReflectionException;

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
     * @param ReflectionParameter $param reflected argument
     * @param CacheInterface $cache container
     * @return null|mixed object in argument
     *
     * @throws NoFoundException for no found service
     * @throws ContainerException for error
     */
    abstract protected function getArg(
        ReflectionParameter $param,
        CacheInterface $cache = null);

   /**
    * Construct AbstractResolver
    * 
    * @return null
    */
   protected function __construct()
   {
   }

   /**
    * Get reflexion class
    *
    * @param string $id service id
    * @return ReflectionClass reflection
    *
    * @throws NoFoundException for no found service
    * @throws ContainerException for error
    */
   protected final function getReflection(string $id): ReflectionClass
   {
       try {
           $reflexion = new ReflectionClass($id);
       } catch (ReflectionException $e) {
           throw new NoFoundException(
               "Can't get reflection for " . $id . ": not found");
       }
       if (!$reflexion->isInstantiable()) {
           throw new ContainerException(
               "Can't get reflection for " . $id . ": not instanciable");
       }
       return $reflexion;
   }

   /**
    * Resolve service
    *
    * @param string $id service id
    * @param ServiceContainerInterface $service service
    * @return mixed service or null
    *
    * @throws NoFoundException for no found service
    * @throws ContainerException for error
    */
   public final function resolve(string $id, CacheInterface $cache = null)
   {
       try {
           if (null !== $cache && $cache->has($id)) {
               return $cache->get($id);
           }
           $reflexion = $this->getReflection($id);
           $args = [];
           foreach ($reflexion->getConstructor()->getParameters() as $param) {
               $args[] = $this->getArg($param, $cache);
           }
           $instance = $reflexion->newInstanceArgs($args);
           if (null !== $cache) {
               $cache->set($id, $instance);
           }
           return $instance;
       } catch (NoFoundException $e) {
           throw new NoFoundException(
                   "Can't resolve " . $id . ": " . $e->getMessage());
       } catch (Throwable $e) {
           throw new ContainerException(
                   "Can't resolve " . $id . ": " . $e->getMessage());
       }
   }

}
