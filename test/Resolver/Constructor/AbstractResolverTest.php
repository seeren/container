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
 * @version 1.0.1
 */

namespace Seeren\Container\Test\Resolver\Constructor;

use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;

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
    * Assert resolve without dependencies
    */
   protected function assertResolveWithoutDependencie()
   {
       $this->assertTrue($this->getResolver()->resolve(Bar::class)
              instanceof Bar);
   }

   /**
    * Assert resolve NotFoundException
    */
   protected function assertResolveNotFoundException()
   {
       $this->getResolver()->resolve("foo");
   }

   /**
    * Assert resolve ContainerExceptionInterface
    */
   protected function assertResolveContainerExceptionInterface()
   {
       $this->getResolver()->resolve(Foo::class);
   }

   /**
    * Assert resolve abstract
    */
   protected function assertResolveAbstract()
   {
       $this->getResolver()->resolve(Baz::class);
   }

   /**
    * Assert resolve and cache
    */
   protected function assertResolveAndCache()
   {
       $cache = $this->getCache();
       $this->getResolver()->resolve(Bar::class, $cache);
       $this->assertTrue($cache->get(Bar::class) instanceof Bar);
   }

   /**
    * Assert use cache
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
