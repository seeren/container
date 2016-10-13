<?php

/**
 * This file contain Seeren\Container\Test\ResolverContainerTest class
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

namespace Seeren\Container\Test;

use Psr\Container\ContainerInterface;
use Seeren\Container\Container;
use Seeren\Container\Resolver\Constructor\TypeHintingResolver;
use Seeren\Container\Resolver\ResolverContainer;

/**
 * Class for test ResolverContainer
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test
 */
class ResolverContainerTest extends ContainerInterfaceTest
{

   /**
    * Get ContainerInterface
    * 
    * @return ContainerInterface container
    */
   protected function getContainerInterface(): ContainerInterface
   {
       return $this->getMock(
           ResolverContainer::class,
           [],
           [
                $this->getMock(TypeHintingResolver::class)
           ]
       );
   }

}
