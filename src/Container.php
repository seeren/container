<?php

/**
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @author Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.5
 */

namespace Seeren\Container;

use Psr\Container\ContainerInterface;
use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;
use Seeren\Container\Service\ServiceInterface;
use Seeren\Container\Exception\NotFoundException;
use Seeren\Container\Exception\ContainerException;

/**
 * Class for represent a container
 * 
 * @category Seeren
 * @package Container
 * @see http://www.php-fig.org/psr/psr-11/
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
    * @param ResolverInterface $resolver
    * @param CacheInterface $cache
    */
   public function __construct(ResolverInterface $resolver, CacheInterface $cache)
   {
       $this->resolver = $resolver;
       $this->cache = $cache;
   }

   /**
    * {@inheritDoc}
    * @see \Psr\Container\ContainerInterface::get()
    */
   public final function get($className)
   {
       try {
           return $this->cache->get(... func_get_args());
       } catch (NotFoundException $e) {
           try {
               $service = $this->resolver->resolve($className, $this->cache);
           } catch (NotFoundException $e) {
               throw $e;
           } catch (ContainerException $e) {
               throw $e;
           }
       }
       $this->cache->set($className, $service);
       return $this->cache->get($className);
   }

   /**
    * {@inheritDoc}
    * @see \Psr\Container\ContainerInterface::has()
    */
   public final function has($className): bool
   {
       return $this->cache->has($className);
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Container\Resolver\ResolverInterface::resolve()
    */
   public final function resolve(string $className, CacheInterface $cache = null)
   {
       try {
           return $this->resolver->resolve($className, $cache);
       } catch (NotFoundException $e) {
           throw $e;
       } catch (ContainerException $e) {
           throw $e;
       }
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Container\Cache\CacheInterface::set()
    */
   public final function set(string $className, $value): CacheInterface
   {
       return $this->cache->set($className, $value);
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Container\Cache\CacheInterface::register()
    */
   public final function register(ServiceInterface $service): CacheInterface
   {
       return $this->cache->register($service);
   }

}
