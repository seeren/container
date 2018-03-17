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
       * @var array service
       */
       $service;

   /**
    * @param array $service
    */
   public function __construct(array $service = [])
   {
       $this->service = $service;
   }

   /**
    * {@inheritDoc}
    * @see \Psr\Container\ContainerInterface::get()
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
    * {@inheritDoc}
    * @see \Psr\Container\ContainerInterface::has()
    */
   public final function has($className): bool
   {
       return array_key_exists($className, $this->service);
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Container\Cache\CacheInterface::set()
    */
   public final function set(string $className, $value): CacheInterface
   {
       $this->service[$className] = $value;
       return $this;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Container\Cache\CacheInterface::register()
    */
   public final function register(ServiceInterface $service): CacheInterface
   {
       $service->register($this);
       return $this;
   }

}
