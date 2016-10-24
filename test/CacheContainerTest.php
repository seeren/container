<?php

/**
 * This file contain Seeren\Container\Test\CacheContainerTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.1
 */

namespace Seeren\Container\Test;

use Psr\Container\ContainerInterface;
use Seeren\Container\Cache\CacheContainer;

/**
 * Class for test CacheContainer
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test
 */
class CacheContainerTest extends ContainerInterfaceTest
{

   /**
    * Get ContainerInterface
    * 
    * @return ContainerInterface container
    */
   protected function getContainerInterface(): ContainerInterface
   {
       $container = $this->getMock(CacheContainer::class);
       $container->set(Foo::class, function ($c) {
           return new Foo;
       });
       $container->set(Bar::class, new Bar);
       return $container;
   }

}
