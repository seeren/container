<?php

/**
 * This file contain Seeren\Container\Test\AbstractContainerTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/container
 * @version 1.1.2
 */

namespace Seeren\Container\Test;

use Psr\Container\ContainerInterface;
use Exception;

/**
 * Class for test ContainerInterface
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test
 * @abstract
 */
abstract class AbstractContainerTest extends \PHPUnit\Framework\TestCase
{

   /**
    * Get Container
    * 
    * @return ContainerInterface controller
    */
   abstract protected function getContainer(): ContainerInterface;

   /**
    * Test get NotFoundException
    */
   public function testGetNotFoundException()
   {
       $this->getContainer()->get("foo");
   }

   /**
    * Test get ContainerExceptionInterface
    */
   public function testGetContainerExceptionInterface()
   {
       $this->getContainer()->get(Foo::class);
   }

   /**
    * Test get
    */
   public function testGet()
   {
       $this->assertTrue($this->getContainer()->get(Bar::class) instanceof Bar);
   }

   /**
    * Test has false
    */
   public function testHasFalse()
   {
       $this->assertFalse($this->getContainer()->has(Baz::class));
   }

}

class Foo
{

    public function __construct()
    {
        throw new Exception();
    }

}

class Bar
{

    public function __construct()
    {   
    }

}

class Baz
{

    public function __construct()
    {
    }

}
