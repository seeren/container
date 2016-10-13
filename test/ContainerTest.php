<?php

/**
 * This file contain Seeren\Container\Test\ContainerTest class
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
use Seeren\Container\Cache\CacheContainer;
use Seeren\Container\Resolver\Constructor\TypeHintingResolver;

/**
 * Class for test Container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test
 */
class ContainerTest extends ContainerInterfaceTest
{

   /**
    * Get ContainerInterface
    * 
    * @return ContainerInterface container
    */
   protected function getContainerInterface(): ContainerInterface
   {
       return $this->getMock(
           Container::class,
           [],
           [
                $this->getMock(TypeHintingResolver::class),
                $this->getMock(CacheContainer::class)
           ]
       );
   }

}
