<?php

/**
 * This file contain Seeren\Container\Ioc\IocInterface interface
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

namespace Seeren\Container\Ioc;

use Seeren\Container\Service\ServiceContainerInterface;

/**
 * Interface for represent a ioc
 * 
 * @category Seeren
 * @package Container
 * @subpackage Ioc
 */
interface IocInterface
{

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
       ServiceContainerInterface $service);

}
