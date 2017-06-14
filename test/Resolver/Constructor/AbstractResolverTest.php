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
 * @link https://github.com/seeren/container
 * @version 1.0.2
 */

namespace Seeren\Container\Test\Resolver\Constructor;

use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;
use Exception;

/**
 * Class for test ResolverInterface
 * 
 * @category Seeren
 * @package Container
 * @subpackage Test\Resolver\Constructor
 * @abstract
 */
abstract class AbstractResolverTest extends \PHPUnit\Framework\TestCase
{

   /**
    * Get Resolver
    * 
    * @return ResolverInterface resolver
    */
   abstract protected function getResolver(): ResolverInterface;

   /**
    * Get Cache
    *
    * @return CacheInterface cache
    */
   abstract protected function getCache(): CacheInterface;

   /**
    * Test resolve without dependencies
    */
   public function testResolveWithoutDependencie()
   {
       $this->assertTrue($this->getResolver()->resolve(Bar::class)
              instanceof Bar);
   }

   /**
    * Test resolve NotFoundException
    */
   public function testResolveNotFoundException()
   {
       $this->getResolver()->resolve("foo");
   }

   /**
    * Test resolve ContainerExceptionInterface
    */
   public function testResolveContainerExceptionInterface()
   {
       $this->getResolver()->resolve(Foo::class);
   }

   /**
    * Test resolve abstract
    */
   public function testResolveAbstract()
   {
       $this->getResolver()->resolve(Baz::class);
   }

   /**
    * Test resolve and cache
    */
   public function testResolveAndCache()
   {
       $cache = $this->getCache();
       $this->getResolver()->resolve(Bar::class, $cache);
       $this->assertTrue($cache->get(Bar::class) instanceof Bar);
   }

   /**
    * Test use cache
    */
   protected function assertUseCache()
   {
       $resolver = $this->getResolver();
       $cache = $this->getCache();
       $resolver->resolve(Bar::class, $cache);
       $this->assertTrue($resolver->resolve(Bar::class, $cache)
                     === $cache->get(Bar::class));
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

abstract class Baz
{

    public function __construct()
    {
    }

}
