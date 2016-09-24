<?php

/**
 * This file contain Seeren\Container\Ioc\IocResolverInterface interface
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

use ReflectionClass;

/**
 * Interface for represent a ioc revolver
 * 
 * @category Seeren
 * @package Container
 * @subpackage Ioc
 */
interface IocResolverInterface extends IocInterface
{

   /**
    * Get reflexion class
    *
    * @param string $id service id
    * @return ReflectionClass
    *
    * @throws NoFoundException for no found class
    * @throws ContainerException if class not instanciable
    */
   public function getReflection(string $id): ReflectionClass;

}
