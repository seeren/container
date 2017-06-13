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
 * @link https://github.com/seeren/container
 * @version 1.1.1
 */

namespace Seeren\Container\Resolver;

use Psr\Container\ContainerInterface;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;

/**
 * Class for represent a resolver container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Resolver
 * @see http://www.php-fig.org/psr/psr-11/
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
    * @param string $className service id
    * @param CacheInterface $cache cache container
    * @return mixed service
    *
    * @throws NotFoundException for no found service
    * @throws ContainerException for error
    */
   public final function get($className, CacheInterface $cache = null)
   {
       try {
           return $this->resolve($className, $cache);
       } catch (NotFoundException $e) {
           throw $e;
       } catch (ContainerException $e) {
           throw $e;
       }
   }

   /**
    * Has service
    * 
    * @param string $className service id
    * @return boolean
    */
   public final function has($className): bool
   {
       return false;
   }

   /**
    * Resolve service
    * 
    * @param string $className service id
    * @param CacheInterface $cache cache container
    * @return mixed service or null
    * 
    * @throws NotFoundException for no found service
    * @throws ContainerException for error
    */
   public final function resolve(string $className, CacheInterface $cache = null)
   {
       try {
           return $this->resolver->resolve($className, $cache);
       } catch (NotFoundException $e) {
           throw $e;
       } catch (ContainerException $e) {
           throw $e;
       }
   }

}
