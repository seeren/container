<?php

/**
 * This file contain Seeren\Container\Resolver\IocContainer class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.1
 */

namespace Seeren\Container\Resolver;

use Psr\Container\ContainerInterface;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NoFoundException;
use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;

/**
 * Class for represent a resolver container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Resolver
 */
class ResolverContainer implements ResolverInterface, ContainerInterface
{

   /**
    * Construct ResolverContainer
    * 
    * @param ResolverInterface $resolver resolver
    * @return null
    */
   public function __construct(ResolverInterface $resolver)
   {
       $this->resolver = $resolver;
   }

   /**
    * Get service
    *
    * @param string $id service id
    * @param CacheInterface $cache cache container
    * @return mixed service
    *
    * @throws NoFoundException for no found service
    * @throws ContainerException for error
    */
   public final function get($id, CacheInterface $cache = null)
   {
       try {
           return $this->resolve($id, $cache);
       } catch (NoFoundException $e) {
           throw $e;
       } catch (ContainerException $e) {
           throw $e;
       }
   }

   /**
    * Has service
    * 
    * @param string $id service id
    * @return boolean
    */
   public final function has($id): bool
   {
       return false;
   }

   /**
    * Resolve service
    * 
    * @param string $id service id
    * @param CacheInterface $cache cache container
    * @return mixed service or null
    * 
    * @throws NoFoundException for no found service
    * @throws ContainerException for error
    */
   public final function resolve(string $id, CacheInterface $cache = null)
   {
       try {
           return $this->resolver->resolve($id, $cache);
       } catch (NoFoundException $e) {
           throw $e;
       } catch (ContainerException $e) {
           throw $e;
       }
   }

}
