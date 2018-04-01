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
use Seeren\Container\Resolver\Constructor\TypeHintingResolver;
use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;
use ReflectionClass;

/**
 * Class for test TypeHintingResolver
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test\Resolver\Constructor
 */
class TypeHintingResolverTest extends AbstractResolverTest
{

    /**
     * Get Resolver
     *
     * @return ResolverInterface resolver
     */
    protected function getResolver(): ResolverInterface
    {
       return (new ReflectionClass(TypeHintingResolver::class))
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
     * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
     * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
     */
    public function testResolveWithoutDependencie()
    {
       parent::testResolveWithoutDependencie();
    }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Exception\NotFoundException::__construct
    * @expectedException \Psr\Container\NotFoundExceptionInterface
    */
   public function testResolveNotFoundException()
   {
       parent::testResolveNotFoundException();
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testResolveContainerExceptionInterface()
   {
       parent::testResolveContainerExceptionInterface();
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Exception\ContainerException::__construct
    * @expectedException \Psr\Container\ContainerExceptionInterface
    */
   public function testResolveAbstract()
   {
       parent::testResolveAbstract();
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
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
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
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
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::getArg
    */
   public function testResolveOneDependencie()
   {
       $this->assertTrue($this->getResolver()->resolve(Waldo::class)
              instanceof Waldo);
   }

   /**
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::resolve
    * @covers \Seeren\Container\Resolver\Constructor\AbstractResolver::getReflection
    * @covers \Seeren\Container\Resolver\Constructor\TypeHintingResolver::getArg
    */
   public function testResolveManyDependencie()
   {
       $this->assertTrue($this->getResolver()->resolve(Fred::class)
           instanceof Fred);
   }

}

class Waldo
{

    public function __construct(Bar $bar)
    {
    }

}

class Fred
{

    public function __construct(Waldo $waldo, Bar $bar)
    {
    }

}
