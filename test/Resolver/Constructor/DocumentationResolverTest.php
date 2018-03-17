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
 * @version 2.0.2
 */

namespace Seeren\Container\Test\Resolver\Constructor;


use Seeren\Container\Cache\CacheContainer;
use Seeren\Container\Resolver\Constructor\DocumentationResolver;
use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;
use ReflectionClass;

/**
 * Class for test DocumentationResolver
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
       parent::testResolveWithoutDependencie();
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
       parent::testResolveNotFoundException();
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
       parent::testResolveContainerExceptionInterface();
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
       parent::testResolveAbstract();
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
       parent::testResolveAndCache();
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
    */
   public function testResolveOneDependencie()
   {
       $this->assertTrue($this->getResolver()->resolve(Qux::class)
              instanceof Qux);
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::getArg
    */
   public function testResolveOneDependencieOptional()
   {
       $this->assertTrue($this->getResolver()->resolve(Quux::class)
           instanceof Quux);
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::getArg
    * @covers \Seeren\Container\Exception\NotFoundException::__construct
    * @expectedException \Psr\Container\NotFoundExceptionInterface
    */
   public function testResolveOneDependencieNotFoundException()
   {
       $this->getResolver()->resolve(Corge::class);
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::getArg
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testResolveOneDependencieContainerException()
   {
       $this->getResolver()->resolve(Grault::class);
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::__construct
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\DocumentationResolver::getArg
    */
   public function testResolveManyDependencie()
   {
       $this->assertTrue($this->getResolver()->resolve(Garply::class)
           instanceof Garply);
   }

}

class Qux
{
    
    /**
     * @param \Seeren\Container\Test\Resolver\Constructor\Bar $bar
     */
    public function __construct(Bar $bar)
    {
    }

}

class Quux
{
    
    /**
     * Not documented
     */
    public function __construct(Bar $bar = null)
    {
    }

}

class Corge
{

    /**
     * @param \BarNotFound $bar
     */
    public function __construct(Bar $bar)
    {
    }

}

class Grault
{

    /**
     * @param \Seeren\Container\Test\Resolver\Constructor\Foo $foo
     */
    public function __construct(Foo $foo)
    {
    }

}

class Garply
{

    /**
     * @param \Seeren\Container\Test\Resolver\Constructor\Qux $qux
     * @param \Seeren\Container\Test\Resolver\Constructor\Bar $bar
     */
    public function __construct(Qux $qux, Bar $bar)
    {
    }

}
