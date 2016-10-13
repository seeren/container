<?php

/**
 * This file contain Seeren\Container\Test\ContainerInterfaceTest class
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
use Psr\Container\Exception\ContainerException;
use Psr\Container\Exception\NotFoundException;
use Exception;

/**
 * Class for test ControllerInterface
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test
 * @abstract
 */
abstract class ContainerInterfaceTest extends \PHPUnit_Framework_TestCase
{

   /**
    * Get ControllerInterface
    * 
    * @return ControllerInterface controller
    */
   abstract protected function getContainerInterface(): ContainerInterface;

   /**
    * Test ContainerInterface::get
    *
    * @expectedException Psr\Container\Exception\NotFoundException
    */
   public final function testGetNotFoundException()
   {
       $this->getContainerInterface()->get("foo");
   }

   /**
    * Test ContainerInterface::get
    * 
    * @expectedException Psr\Container\Exception\ContainerException
    *
    */
   public final function testGetContainerException()
   {
       $this->getContainerInterface()->get(Foo::class);
   }

   /**
    * Test ContainerInterface::get
    */
   public final function testGet()
   {
       $this->assertTrue(
           is_object($this->getContainerInterface()->get(Bar::class))
       );
   }

   /**
    * Test ContainerInterface::has
    */
   public final function testHas()
   {
       $this->assertFalse(
           $this->getContainerInterface()->has(Baz::class)
      );
   }

}

class Foo { function __construct(){throw new Exception(); } }

class Bar {function __construct(){} }

class Baz {function __construct(){} }
