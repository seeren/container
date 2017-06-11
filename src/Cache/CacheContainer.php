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
 * @link https://github.com/seeren/container
 * @version 1.1.2
 */

namespace Seeren\Container\Cache;

use Psr\Container\ContainerInterface;
use Seeren\Container\Service\ServiceInterface;
use Seeren\Container\Exception\NotFoundException;
use Seeren\Container\Exception\ContainerException;
use Throwable;

/**
 * Class for represent a cache container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Cache
 * @see http://www.php-fig.org/psr/psr-11/
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
    * @throws NotFoundException for no found service
    * @throws ContainerException for error
    */
   public final function get($className)
   {
       if (!$this->has($className)) {
           throw new NotFoundException(
               "Can't get " . $className . ": not found");
       } else if (is_callable($this->service[$className])) {
           $args = func_get_args();
           $args[0] = $this;
           try {
               $this->service[$className] = $this->service[$className](...$args);
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
    * @return CacheInterface self
    */
   public final function set(string $className, $value): CacheInterface
   {
       $this->service[$className] = $value;
       return $this;
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

}
