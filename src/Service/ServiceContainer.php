<?php

/**
 * This file contain Seeren\Container\Service\ServiceContainer class
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

namespace Seeren\Container\Service;

use Psr\Container\ContainerInterface;
use Seeren\Container\Exception\{ContainerException, NoFoundException};
use Throwable;

/**
 * Class for represent a service container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Service
 */
class ServiceContainer implements ServiceContainerInterface, ContainerInterface
{

   protected
      /**
       * @var array service collection
       */
       $service;

   /**
    * Construct ServiceContainer
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
    * @param string $id service id
    * @return mixed service
    *
    * @throws Psr\Container\Exception\NotFoundException for no found service
    * @throws Psr\Container\Exception\ContainerException for error
    */
   public final function get($id)
   {
       if (!$this->has($id)) {
           throw new NoFoundException(
               "Can't get : not found " . $id);
       } else  if (is_callable($this->service[$id])) {
           try {
               $args = func_get_args();
               $args[0] = $this;
               $this->service[$id] = $this->service[$id](...$args);
           } catch (Throwable $e) {
               throw new ContainerException(
                   "Can't get : " . $id . ": " . $e->getMessage());
           }
       }
       return $this->service[$id];
    }

   /**
    * Has service
    * 
    * @param string $id service id
    * @return boolean
    */
   public final function has($id)
   {
       return array_key_exists($id, $this->service);
   }

   /**
    * Set service
    *
    * @param string $id service id
    * @param mixed $value service value
    * @return null
    */
   public final function set(string $id, $value)
   {
       $this->service[$id] = $value;
   }

   /**
    * Remove service
    *
    * @param string $id service id
    * @return bool unset or not
    */
   public final function remove(string $id): bool
   {
       if ($this->has($id)) {
           unset($this->service[$id]);
           return true;
       }
       return false;
   }

   /**
    * Register service provider
    *
    * @param ServiceProviderInterface $service service provider
    * @return ServiceContainerInterface self
    */
   public final function register(
       ServiceProviderInterface $service): ServiceContainerInterface
   {
       $service->register($this);
       return $this;
   }

   /**
    * Unregister service provider
    *
    * @param ServiceProviderInterface $service service provider
    * @return ServiceContainerInterface self
    */
   public final function unregister(
       ServiceProviderInterface $service): ServiceContainerInterface
   {
       $service->unregister($this);
       return $this;
   }

}
