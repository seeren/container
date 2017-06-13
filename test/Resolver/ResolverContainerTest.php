<?php

/**
 * This file contain Seeren\Container\Test\Resolver\ResolverContainerTest class
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

namespace Seeren\Container\Test\Resolver;

use Psr\Container\ContainerInterface;
use Seeren\Container\Resolver\ResolverContainer;
use Seeren\Container\Test\AbstractContainerTest;
use Seeren\Container\Resolver\Constructor\DocumentationResolver;
use ReflectionClass;
use Seeren\Container\Test\Foo;

/**
 * Class for test ResolverContainer
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test\Resolver
 */
class ResolverContainerTest extends AbstractContainerTest
{

   /**
    * Get Container
    * 
    * @return ContainerInterface container
    */
   protected function getContainer(): ContainerInterface
   {
       return (new ReflectionClass(ResolverContainer::class))
       ->newInstanceArgs([
           (new ReflectionClass(DocumentationResolver::class))
            ->newInstanceArgs([])
       ]);
   }

   /**
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\ResolverContainer::get
    * @covers \Seeren\Container\Resolver\ResolverContainer::has
    * @covers \Seeren\Container\Exception\NotFoundException::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::resolve
    * @covers \Seeren\Container\Resolver\ResolverContainer::resolve
    * @expectedException \Psr\Container\NotFoundExceptionInterface
    * 
    */
   public function testGetNotFoundException()
   {
       parent::assertGetNotFoundException();
   }

   /**
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\ResolverContainer::get
    * @covers \Seeren\Container\Resolver\ResolverContainer::has
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::resolve
    * @covers \Seeren\Container\Resolver\ResolverContainer::resolve
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testGetContainerExceptionInterface()
   {
       parent::assertGetContainerExceptionInterface();
   }

   /**
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\ResolverContainer::get
    * @covers \Seeren\Container\Resolver\ResolverContainer::has
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::resolve
    * @covers \Seeren\Container\Resolver\ResolverContainer::resolve
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    */
   public function testGet()
   {
       parent::assertGet();
   }

   /**
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\ResolverContainer::has
    */
   public function testHasFalse()
   {
       parent::assertHasFalse();
   }

   /**
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Exception\NotFoundException::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::resolve
    * @covers \Seeren\Container\Resolver\ResolverContainer::resolve
    * @expectedException \Psr\Container\NotFoundExceptionInterface
    *
    */
   public function testResolveNotFoundException()
   {
       $this->getContainer()->resolve("foo");
   }

   /**
    * @covers \Seeren\Container\Resolver\ResolverContainer::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::resolve
    * @covers \Seeren\Container\Resolver\ResolverContainer::resolve
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testResolveContainerExceptionInterface()
   {
       $this->getContainer()->resolve(Foo::class);
   }

}


class Qux
{

    public function __construct()
    {
    }

}
