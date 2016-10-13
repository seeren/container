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

use Seeren\Container\Cache\CacheInterface;

/**
 * Class for represent a service provider
 * 
 * @category Seeren
 * @package Container
 * @subpackage Service
 * @abstract
 */
abstract class ServiceProvider implements ServiceInterface
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
   protected function __construct()
   {
       $this->service = [];
   }

   /**
    * Register container
    *
    * @param CacheInterface $container cache container
    * @return ServiceInterface provider
    */
   public final function register(
       CacheInterface $container): ServiceInterface
   {
       foreach ($this->service as $key => &$value) {
           $container->set($key, $value);
       }
       return $this;
   }

   /**
    * Unregister container
    *
    * @param CacheInterface $container cache container
    * @return ServiceInterface provider
    */
   public final function unregister(
       CacheInterface $container): ServiceInterface
   {
       foreach (array_keys($this->service) as $key) {
           $container->remove($key);
       }
       return $this;
   }

}
