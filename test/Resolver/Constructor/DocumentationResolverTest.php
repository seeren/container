<?php

/**
 * This file contain Seeren\Container\Test\Resolver\Constructor\AbstractResolverTest class
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

namespace Seeren\Container\Test\Resolver\Constructor;


use Seeren\Container\Cache\CacheContainer;
use Seeren\Container\Resolver\Constructor\DocumentationResolver;
use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;
use ReflectionClass;

/**
 * Class for test CacheContainer
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test\Resolver\Constructor
 */
class DocumentationResolverTest extends AbstractResolverTest
{

    /**
     * Get Resolver
     *
     * @return ResolverInterface resolver
     */
    protected function getResolver(): ResolverInterface
    {
       return (new ReflectionClass(DocumentationResolver::class))
       ->newInstanceArgs([]);
    }

    /**
     * Get Cache
     *
     * @return CacheInterface cache
     */
    protected function getCache(): CacheInterface
    {
       return (new ReflectionClass(CacheContainer::class))
       ->newInstanceArgs([]);
    }

    /**
     * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
     * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
     * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
     * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
     */
    public function testResolveWithoutDependencie()
    {
       parent::assertResolveWithoutDependencie();
    }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Exception\NotFoundException::__construct
    * @expectedException \Psr\Container\NotFoundExceptionInterface
    */
   public function testResolveNotFoundException()
   {
       parent::assertResolveNotFoundException();
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testResolveContainerExceptionInterface()
   {
       parent::assertResolveContainerExceptionInterface();
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testResolveAbstract()
   {
       parent::assertResolveAbstract();
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers \Seeren\Container\Cache\CacheContainer::set
    */
   public function testResolveAndCache()
   {
       parent::assertResolveAndCache();
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Cache\CacheContainer::__construct
    * @covers \Seeren\Container\Cache\CacheContainer::get
    * @covers \Seeren\Container\Cache\CacheContainer::has
    * @covers \Seeren\Container\Cache\CacheContainer::set
    */
   public function testtUseCache()
   {
       parent::assertUseCache();
   }


   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::getArg
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::getClassName
    */
   public function testResolveOneDependencie()
   {
       $this->assertTrue($this->getResolver()->resolve(Qux::class)
                         instanceof Qux);
   }

}

class Qux
{
    
    /**
     * @param \Seeren\Container\Test\Resolver\Constructor\Bar $bar bar test
     */
    public function __construct(Bar $bar)
    {
    }

}
