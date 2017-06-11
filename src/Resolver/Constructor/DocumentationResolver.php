<?php

/**
 * This file contain Seeren\Container\Resolver\Constructor\DocumentationResolver
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
 * @version 1.1.2
 */

namespace Seeren\Container\Resolver\Constructor;

use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NoFoundException;
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
    * Construct DocumentationResolver
    * 
    * @return null
    */
   public function __construct()
   {
       parent::__construct();
   }

   /**
    * Get doc comment class name
    *
    * @param string $paramName argument name
    * @param string $docComment doc comment
    * @return string class name
    */
   private final function getClassName(
       string $paramName,
       string $docComment): string
   {
       $match = [];
       $delimiter = "@param";
       $type = "string|int|bool|float|array|callable";
       preg_match(
           '/^.+' . $delimiter . '\s+(?!' . $type
         . ')([A-Za-z0-9\\\]{1,})\s+\$'
         . $paramName . '/m',
           $docComment,
           $match);
       return array_key_exists(1, $match) ? $match[1] : "";
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
           return ($className = $this->getClassName(
                       $param->name,
                       $param->getDeclaringFunction()->getDocComment()))
                ? $this->resolve($className, $cache)
                : null;
       } catch (NoFoundException $e) {
           throw new NoFoundException(
               "Can't use documentation for " . $param . ": "
             . $e->getMessage());
       } catch (Throwable $e) {
           throw new ContainerException(
               "Can't use documentation for " . $param . ": "
             . $e->getMessage());
       }
   }

}
