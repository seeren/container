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
    * {@inheritDoc}
    * @see \Seeren\Container\Resolver\Constructor\AbstractResolver::getArg()
    */
    protected final function getArg(ReflectionParameter $param, CacheInterface $cache = null)
   {
           return !$param->isOptional()
               && ($type = $param->getType()) && !$type->isBuiltin()
                ? $this->resolve($type->__toString(), $cache)
                : null;
   }

}
