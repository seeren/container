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
    * @param ResolverInterface $resolver resolver
    */
   public function __construct(ResolverInterface $resolver)
   {
       $this->resolver = $resolver;
   }

   /**
    * {@inheritDoc}
    * @see \Psr\Container\ContainerInterface::get()
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
    * {@inheritDoc}
    * @see \Psr\Container\ContainerInterface::has()
    */
   public final function has($className): bool
   {
       return false;
   }

   /**
    * {@inheritDoc}
    * @see \Seeren\Container\Resolver\ResolverInterface::resolve()
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
