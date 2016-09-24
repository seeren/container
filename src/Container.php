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
use Seeren\Container\Service\{ServiceProviderInterface, ServiceContainerInterface};
use Seeren\Container\Ioc\IocInterface;
use Throwable;

/**
 * Class for represent a container
 * 
 * @category Seeren
 * @package Container
 */
class Container implements
    ContainerInterface,
    IocInterface, 
    ServiceContainerInterface
{

   protected
       /**
        * @var IocInterface ioc container
        */
       $ioc,
       /**
        * @var ServiceContainerInterface service container
        */
       $service;

   /**
    * Construct Container
    *      
    * @param Seeren\Container\Ioc\IocContainer $ioc ioc
    * @param Seeren\Container\Service\ServiceContainer $service service
    * @return null
    */
   public function __construct(
       IocInterface $ioc,
       ServiceContainerInterface $service)
   {
       $this->ioc = $ioc;
       $this->service = $service;
   }

   /**
    * Get service
    *
    * @param string $id service id
    * @return mixed service
    *
    * @throws Psr\Container\Exception\NoFoundException for no found service
    * @throws Psr\Container\Exception\ContainerException for error
    */
   public function get($id)
   {
       try {
           return $this->service->get(... func_get_args());
       } catch (Throwable $e) {
           try {
               $this->set($id, $this->ioc->get($id, $this->service));
               return $this->get($id);
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
   public function has($id)
   {
       return $this->service->has($id);
   }

   /**
    * Resolve service
    *
    * @param string $id service id
    * @param ServiceContainerInterface $service service
    * @return mixed service or null
    *
    * @throws Psr\Container\Exception\NoFoundException for no found service
    * @throws Psr\Container\Exception\ContainerException for error
    */
   public function resolve(
       string $id,
       ServiceContainerInterface $service = null)
   {
       try {
           return $this->ioc->resolve($id, $service);
       } catch (NoFoundException $e) {
           throw $e;
       } catch (ContainerException $e) {
           throw $e;
       }
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
       $this->service->set($id, $value);
   }

   /**
    * Remove service
    *
    * @param string $id service id
    * @return bool unset or not
    */
   public final function remove(string $id): bool
   {
       return $this->service->remove($id);
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
       $this->service->register($service);
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
       $this->service->unregister($service);
   }

}
