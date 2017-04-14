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
 * @version 1.2.1
 */

namespace Seeren\Container\Test;

use Psr\Container\ContainerInterface;
use Seeren\Container\Container;
use Seeren\Container\Cache\CacheContainer;
use Seeren\Container\Resolver\Constructor\TypeHintingResolver;
use ReflectionClass;

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
       return (new ReflectionClass(Container::class))
            ->newInstanceArgs([
                (new ReflectionClass(TypeHintingResolver::class))
                ->newInstanceArgs([]),
                (new ReflectionClass(CacheContainer::class))
                ->newInstanceArgs([])
        ]);
   }

}
