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
 * @version 1.0.1
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
    * @return ControllerInterface controller
    */
   abstract protected function getContainer(): ContainerInterface;

   /**
    * Assert get NotFoundException
    */
   protected function assertGetNotFoundException()
   {
       $this->getContainer()->get("foo");
   }

   /**
    * Assert get ContainerExceptionInterface
    */
   protected function assertGetContainerExceptionInterface()
   {
       $this->getContainer()->get(Foo::class);
   }

   /**
    * Assert get
    */
   protected function assertGet()
   {
       $this->assertTrue($this->getContainer()->get(Bar::class) instanceof Bar);
   }

   /**
    * Assert has true
    */
   protected function assertHasTrue()
   {
       $this->assertTrue($this->getContainer()->has(Bar::class));
   }

   /**
    * Assert has false
    */
   protected function assertHasFalse()
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
