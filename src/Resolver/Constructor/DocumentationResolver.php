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
 * @version 1.2.2
 */

namespace Seeren\Container\Resolver\Constructor;

use Seeren\Container\Resolver\ResolverInterface;
use Seeren\Container\Cache\CacheInterface;
use ReflectionParameter;

/**
 * Class for represent a constructor documentation resolver
 * 
 * @category Seeren
 * @package Container
 * @subpackage Resolver\Constructor
 */
class DocumentationResolver extends AbstractResolver implements
    ResolverInterface
{

   /**
    * {@inheritDoc}
    * @see \Seeren\Container\Resolver\Constructor\AbstractResolver::getArg()
    */
    protected final function getArg(ReflectionParameter $param, CacheInterface $cache = null)
   {
       $match = [];
       $delimiter = "@param";
       $type = "string|int|bool|float|array|callable";
       preg_match(
           '/^.+' . $delimiter . '\s+(?!' . $type
         . ')([A-Za-z0-9\\\]{1,})\s+\$'
         . $param->name . '/m',
           $param->getDeclaringFunction()->getDocComment(),
           $match);
       if (array_key_exists(1, $match)) {
           return $this->resolve($match[1], $cache);
       }
   }

}
