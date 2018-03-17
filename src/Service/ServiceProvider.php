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
        * @var array service
        */
       $service;

   /**
    * @param array $service
    */
   protected function __construct(array $service = [])
   {
       $this->service = $service;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Container\Service\ServiceInterface::register()
    */
   public final function register(CacheInterface $container): ServiceInterface
   {
       foreach ($this->service as $key => &$value) {
           $container->set($key, $value);
       }
       return $this;
   }

}
