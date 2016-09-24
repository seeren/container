<?php

/**
 * This file contain Seeren\Container\Service\ServiceProviderInterface interface
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
 * Interface for represent a service provider
 * 
 * @category Seeren
 * @package Container
 * @subpackage Service
 */
interface ServiceProviderInterface extends ServiceInterface
{

   /**
    * Register container
    *
    * @param ServiceContainerInterface $container service container
    * @return ServiceProviderInterface self
    */
   public function register(
       ServiceContainerInterface $container): ServiceProviderInterface;

   /**
    * Unregister container
    *
    * @param ServiceContainerInterface $container service container
    * @return ServiceProviderInterface self
    */
   public function unregister(
       ServiceContainerInterface $container): ServiceProviderInterface;

}
