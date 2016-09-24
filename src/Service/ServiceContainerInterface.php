<?php

/**
 * This file contain Seeren\Container\Service\ServiceContainerInterface interface
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
 * Interface for represent a service container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Service
 */
interface ServiceContainerInterface extends ServiceInterface
{

   /**
    * Register service
    *
    * @param ServiceProviderInterface $service service provider
    * @return ServiceContainerInterface self
    */
   public function register(
       ServiceProviderInterface $service): ServiceContainerInterface;

   /**
    * Unregister service
    *
    * @param ServiceProviderInterface $service service provider
    * @return ServiceContainerInterface self
    */
   public function unregister(
       ServiceProviderInterface $service): ServiceContainerInterface;

}
