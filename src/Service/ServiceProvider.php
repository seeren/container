<?php

/**
 * This file contain Seeren\Container\Service\ServiceProvider class
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

/**
 * Class for represent a service provider
 * 
 * @category Seeren
 * @package Container
 * @subpackage Service
 */
class ServiceProvider implements ServiceProviderInterface
{

   protected
       /**
        * @var array service collection
        */
       $service;

   /**
    * Construct ServiceProvider
    * 
    * @return null
    */
   public function __construct()
   {
       $this->service = [];
   }

   /**
    * Set service
    *
    * @param string $id service id
    * @param mixed $value service value
    * @return null
    */
   public function set(string $id, $value)
   {
       $this->service[$id] = $value;
   }

   /**
    * Remove service
    *
    * @param string $id service id
    * @return bool unset or not
    */
   public function remove(string $id): bool
   {
       if (isset($this->service)) {
           unset($this->service[$id]);
           return true;
       }
       return false;
   }

   /**
    * Register container
    *
    * @param ServiceContainerInterface $container service container
    * @return ServiceProviderInterface self
    */
   public function register(
       ServiceContainerInterface $container): ServiceProviderInterface
   {
       foreach ($this->service as $key => &$value) {
           $container->set($key, $value);
       }
       return $this;
   }

   /**
    * Unregister container
    *
    * @param ServiceContainerInterface $container service container
    * @return ServiceProviderInterface self
    */
   public function unregister(
       ServiceContainerInterface $container): ServiceProviderInterface
   {
       foreach ($this->service as $key => &$value) {
           $container->remove($key);
       }
       return $this;
   }

}
