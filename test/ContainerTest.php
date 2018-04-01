<?php

/**
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @author Cyril Ichti <consultant@seeren.fr>
 * @link https://github.com/seeren/container
 * @version 2.0.3
 */

namespace Seeren\Container\Test;

use Psr\Container\ContainerInterface;
use Seeren\Container\Cache\CacheContainer;
use Seeren\Container\Service\ServiceProvider;
use Seeren\Container\Container;
use Seeren\Container\Resolver\ResolverContainer;
use Seeren\Container\Resolver\Constructor\TypeHintingResolver;
use ReflectionClass;

/**
 * Class for test Container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test
 */
class ContainerTest extends AbstractContainerTest
{

   /**
    * Get Container
    * 
    * @return ContainerInterface container
    */
   protected function getContainer(): ContainerInterface
   {
       return (new ReflectionClass(Container::class))
       ->newInstanceArgs([
          (new ReflectionClass(ResolverContainer::class))
           ->newInstanceArgs([
             (new ReflectionClass(TypeHintingResolver::class))
              ->newInstanceArgs([])
           ]),
           (new ReflectionClass(CacheContainer::class))
           ->newInstanceArgs([]),
       ]);
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers Seeren\Container\Container::__construct
    * @covers Seeren\Container\Container::get
    * @covers Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers Seeren\Container\Resolver\Constructor\AbstractResolver::resolve
    * @covers Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers Seeren\Container\Resolver\ResolverContainer::resolve
    * @covers \Seeren\Container\Exception\NotFoundException::__construct
    * @expectedException \Psr\Container\NotFoundExceptionInterface
    */
   public function testGetNotFoundException()
   {
       parent::testGetNotFoundException();
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers Seeren\Container\Container::__construct
    * @covers Seeren\Container\Container::get
    * @covers Seeren\Container\Exception\NotFoundException::__construct
    * @covers Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers Seeren\Container\Resolver\Constructor\AbstractResolver::resolve
    * @covers Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers Seeren\Container\Resolver\ResolverContainer::resolve
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testGetContainerExceptionInterface()
   {
       parent::testGetContainerExceptionInterface();
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers Seeren\Container\Container::__construct
    * @covers Seeren\Container\Container::get
    * @covers Seeren\Container\Exception\NotFoundException::__construct
    * @covers Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers Seeren\Container\Resolver\Constructor\AbstractResolver::resolve
    * @covers Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers Seeren\Container\Resolver\ResolverContainer::resolve
    */
   public function testGet()
   {
       parent::testGet();
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Container::__construct
    * @covers \Seeren\Container\Container::set
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct

    */
   public function testSet()
   {
       $this->assertTrue($this->getContainer()->set("id", true)->get("id"));
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers Seeren\Container\Container::__construct
    * @covers Seeren\Container\Container::has
    * @covers Seeren\Container\Resolver\ResolverContainer::__construct
    */
   public function testHasFalse()
   {
       parent::testHasFalse();
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Container::__construct
    * @covers \Seeren\Container\Container::resolve
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Resolver\ResolverContainer::resolve
    */
   public function testResolveWithoutDependencie()
   {
       $this->assertTrue($this->getContainer()->resolve(Qux::class)
              instanceof Qux);
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Exception\NotFoundException::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Container::__construct
    * @covers \Seeren\Container\Container::resolve
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Resolver\ResolverContainer::resolve
    * @expectedException \Psr\Container\NotFoundExceptionInterface
    */
   public function testResolveNotFoundException()
   {
        $this->getContainer()->resolve("foo");
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Container::__construct
    * @covers \Seeren\Container\Container::resolve
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Resolver\ResolverContainer::resolve
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testResolveContainerExceptionInterface()
   {
       $this->getContainer()->resolve(Foo::class);
   }

   /**
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::set
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers \Seeren\Container\Cache\CacheContainer::register
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Container::__construct
    * @covers \Seeren\Container\Container::has
    * @covers \Seeren\Container\Container::register
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Service\ServiceProvider::__construct
    * @covers \Seeren\Container\Service\ServiceProvider::register
    */
   public function testRegister()
   {
       $container = $this->getContainer();
       $container->register(new ContainerService);
       $this->assertTrue($container->has(Qux::class));
   }

}


class ContainerService extends ServiceProvider
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
