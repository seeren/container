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
 * @link https://github.com/seeren/container
 * @version 1.1.4
 */

namespace Seeren\Container\Resolver\Constructor;

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
class TypeHintingResolver extends AbstractResolver implements ResolverInterface
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
    */
   protected final function getArg(
       ReflectionParameter $param,
       CacheInterface $cache = null)
   {
           return !$param->isOptional()
               && ($type = $param->getType()) && !$type->isBuiltin()
                ? $this->resolve($type->__toString(), $cache)
                : null;
   }

}
