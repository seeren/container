<?php

/**
 * This file contain Seeren\Container\Cache\Test\CacheContainerTest class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 2.0.1
 */

namespace Seeren\Container\Cache\Test;

use Psr\Container\ContainerInterface;
use Seeren\Container\Cache\CacheContainer;
use Seeren\Container\Service\ServiceProvider;
use Seeren\Container\Test\AbstractContainerTest;
use Seeren\Container\Test\Foo;
use Seeren\Container\Test\Bar;

/**
 * Class for test CacheContainer
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test\Cache
 */
class CacheContainerTest extends AbstractContainerTest
{

   /**
    * Get Container
    * 
    * @return ContainerInterface container
    */
   protected function getContainer(): ContainerInterface
   {
       $container = ($this->createMock(CacheContainer::class));
       $container->__construct();
       $container->set(Foo::class, function () {
           return new Foo;
       })
       ->set(Bar::class, function () {
           return new Bar();
       });
       return $container;
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers \Seeren\Container\Exception\NotFoundException::__construct
    * @expectedException \Psr\Container\NotFoundExceptionInterface
    */
   public function testGetNotFoundException()
   {
       parent::assertGetNotFoundException();
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testGetContainerExceptionInterface()
   {
       parent::assertGetContainerExceptionInterface();
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Cache\CacheContainer::has
    */
   public function testGet()
   {
       parent::assertGet();
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::has
    */
   public function testHasTrue()
   {
       parent::assertHasTrue();
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::has
    */
   public function testHasFalse()
   {
       parent::assertHasFalse();
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers \Seeren\Container\Cache\CacheContainer::register
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Service\ServiceProvider::__construct
    * @covers \Seeren\Container\Service\ServiceProvider::register
    */
   public function testRegister()
   {
       $container = $this->getContainer();
       $container->register(new CacheContainerService);
       $this->assertTrue($container->has(Qux::class));
   }

}


class CacheContainerService extends ServiceProvider
{
    
    public function __construct()
    {
        parent::__construct();
        $this->service[Qux::class] = new Qux();
    }

}

class Qux
{

    public function __construct()
    {
    }

}