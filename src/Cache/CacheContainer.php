<?php

/**
 * This file contain Seeren\Container\Cache\ServiceContainer class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.1
 */

namespace Seeren\Container\Cache;

use Psr\Container\ContainerInterface;
use Seeren\Container\Service\ServiceInterface;
use Seeren\Container\Exception\NoFoundException;
use Seeren\Container\Exception\ContainerException;
use Throwable;

/**
 * Class for represent a cache container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Cache
 */
class CacheContainer implements CacheInterface, ContainerInterface
{

   protected
      /**
       * @var array service collection
       */
       $service;

   /**
    * Construct CacheContainer
    * 
    * @return null
    */
   public function __construct()
   {
       $this->service = [];
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
       if (!$this->has($className)) {
           throw new NoFoundException(
               "Can't get " . $className . ": not found");
       } else if (is_callable($this->service[$className])) {
           $args = func_get_args();
           $args[0] = $this;
           try {
               $this->service[$className] = $this->service[$id](...$args);
           } catch (Throwable $e) {
               throw new ContainerException(
                   "Can't get " . $className . ": " . $e->getMessage());
           }
       }
       return $this->service[$className];
    }

   /**
    * Has service
    * 
    * @param string $className service id
    * @return boolean
    */
   public final function has($className): bool
   {
       return array_key_exists($className, $this->service);
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
       $this->service[$className] = $value;
   }

   /**
    * Register service
    *
    * @param ServiceInterface $service service provider
    * @return CacheInterface container
    */
   public final function register(ServiceInterface $service): CacheInterface
   {
       $service->register($this);
       return $this;
   }

   /**
    * Unregister service
    *
    * @param ServiceInterface $service service provider
    * @return CacheInterface container
    */
   public final function unregister(ServiceInterface $service): CacheInterface
   {
       $service->unregister($this);
       return $this;
   }

}
