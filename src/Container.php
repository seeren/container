<?php

/**
 * This file contain Seeren\Container\Container class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.2
 */

namespace Seeren\Container;

use Psr\Container\ContainerInterface;
use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;
use Seeren\Container\Service\ServiceInterface;
use Seeren\Container\Exception\NoFoundException;
use Seeren\Container\Exception\ContainerException;
use Throwable;

/**
 * Class for represent a container
 * 
 * @category Seeren
 * @package Container
 */
class Container implements ContainerInterface, CacheInterface, ResolverInterface
{

   protected
       /**
        * @var ResolverInterface resolver
        */
       $resolver,
       /**
        * @var CacheInterface cache
        */
       $service;

   /**
    * Construct Container
    *      
    * @param ResolverInterface $resolver resolver
    * @param CacheInterface $cache cache
    * @return null
    */
   public function __construct(
       ResolverInterface $resolver,
       CacheInterface $cache)
   {
       $this->resolver = $resolver;
       $this->cache = $cache;
   }

   /**
    * Get service
    *
    * @param string $className service id
    * @return mixed service
    *
    * @throws NoFoundException for no found service
    * @throws ContainerException for error
    */
   public final function get($className)
   {
       try {
           return $this->cache->get(... func_get_args());
       } catch (Throwable $e) {
           try {
               $this->cache->set(
                   $className,
                   $this->resolver->resolve($className, $this->cache));
               return $this->cache->get($className);
           } catch (NoFoundException $e) {
               throw $e;
           } catch (ContainerException $e) {
               throw $e;
           }
       }
   }

   /**
    * Has service
    *
    * @param string $className service id
    * @return boolean
    */
   public final function has($className): bool
   {
       return $this->cache->has($className);
   }

   /**
    * Resolve service
    * 
    * @param string $className service id
    * @param CacheInterface $cache cache container
    * @return mixed service or null
    * 
    * @throws NoFoundException for no found service
    * @throws ContainerException for error
    */
   public final function resolve(string $className, CacheInterface $cache = null)
   {
       try {
           return $this->resolver->resolve($className, $cache);
       } catch (NoFoundException $e) {
           throw $e;
       } catch (ContainerException $e) {
           throw $e;
       }
   }

   /**
    * Set service
    *
    * @param string $className service id
    * @param mixed $value service value
    * @return null
    */
   public final function set(string $className, $value)
   {
       return $this->cache->set($className, $value);
   }

   /**
    * Register service
    *
    * @param ServiceInterface $service service provider
    * @return CacheInterface CacheInterface
    */
   public final function register(ServiceInterface $service): CacheInterface
   {
       return $this->cache->register($service);
   }

   /**
    * Unregister service
    *
    * @param ServiceInterface $service service provider
    * @return CacheInterface CacheInterface
    */
   public final function unregister(ServiceInterface $service): CacheInterface
   {
       return $this->cache->unregister($service);
   }

}
