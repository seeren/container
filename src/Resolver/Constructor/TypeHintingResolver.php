<?php

/**
 * This file contain Seeren\Container\Resolver\Constructor\TypeHintingResolver
 * class
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

namespace Seeren\Container\Resolver\Constructor;

use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NoFoundException;
use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;
use ReflectionParameter;

/**
 * Class for represent a constructor type hinting resolver
 * 
 * @category Seeren
 * @package Container
 * @subpackage Resolver\Constructor
 */
class TypeHintingResolver extends AbstractResolver implements
    ResolverInterface
{

   /**
    * Construct TypeHintingResolver
    * 
    * @return null
    */
   public function __construct()
   {
       parent::__construct();
   }

   /**
    * Get parameter argument
    *
    * @param ReflectionParameter $param reflected argument
    * @param CacheInterface $cache container
    * @return null|mixed object in argument
    *
    * @throws NoFoundException for no found service
    * @throws ContainerException for error
    */
   protected final function getArg(
       ReflectionParameter $param,
       CacheInterface $cache = null)
   {
       try {
           return ($class = $param->getClass())
                ? $this->resolve($class->name, $cache)
                : null;
       } catch (NoFoundException $e) {
           throw new NoFoundException(
               "Can't typehint for " . $param . ": " . $e->getMessage());
       } catch (Throwable $e) {
           throw new ContainerException(
               "Can't typehint for " . $param . ": " . $e->getMessage());
       }
   }

}
