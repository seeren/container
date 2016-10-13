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
 * @version 1.0.1
 */

namespace Seeren\Container;

use Psr\Container\ContainerInterface;
use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;
use Seeren\Container\Exception\NoFoundException;
use Seeren\Container\Exception\ContainerException;
use Throwable;

/**
 * Class for represent a container
 * 
 * @category Seeren
 * @package Container
 */
class Container implements ContainerInterface
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
   public final function __construct(
       ResolverInterface $resolver,
       CacheInterface $cache)
   {
       $this->resolver = $resolver;
       $this->cache = $cache;
   }

   /**
    * Get service
    *
    * @param string $id service id
    * @return mixed service
    *
    * @throws NoFoundException for no found service
    * @throws ContainerException for error
    */
   public final function get($id)
   {
       try {
           return $this->cache->get(... func_get_args());
       } catch (Throwable $e) {
           try {
               $this->cache->set(
                   $id,
                   $this->resolver->resolve($id, $this->cache));
               return $this->cache->get($id);
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
    * @param string $id service id
    * @return boolean
    */
   public final function has($id): bool
   {
       return $this->cache->has($id);
   }

}
