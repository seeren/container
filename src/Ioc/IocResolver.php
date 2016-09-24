<?php

/**
 * This file contain Seeren\Container\Ioc\IocResolver class
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

namespace Seeren\Container\Ioc;

use Seeren\Container\Service\ServiceContainerInterface;
use Seeren\Container\Exception\{ContainerException, NoFoundException};
use ReflectionException;
use ReflectionClass;
use ReflectionParameter;
use Throwable;

/**
 * Class for represent a ioc resolver
 * 
 * @category Seeren
 * @package Container
 * @subpackage Ioc
 */
class IocResolver implements IocResolverInterface
{

   /**
    * Construct IocResolver
    * 
    * @return null
    */
   public function __construct()
   {
   }

   /**
    * Get doc comment class name
    *
    * @param string $name argument name
    * @param string $docComment doc comment
    * @return string class name
    */
   protected final function getClassNameByDoc(
      string &$name,
      string &$docComment): string
   {
      $delimiter = "@param";
      $type = "string|int|bool|float|array|callable";
      preg_match(
          '/^.+' . $delimiter . '\s+(?!' . $type . ')[A-Za-z\\\]{1,}\s+\$'
         . $name . '/m',
           $docComment,
           $match);
      return array_key_exists(0, $match)
           ? trim(strstr(explode($delimiter, $match[0])[1], '$' . $name, 1))
           : "";
    }

   /**
    * Get parameter argument
    *
    * @param ReflectionParameter $param reflected argument
    * @param string $docComment method doc comment
    * @param ServiceContainerInterface $service service
    * @return null|mixed object in argument
    *
    * @throws Psr\Container\Exception\NoFoundException for no found service
    */
   protected final function getArg(
       ReflectionParameter $param,
       string &$docComment,
       ServiceContainerInterface $service = null)
   {
       try {
           return $this->resolve(
               $this->getClassNameByDoc($param->name, $docComment),
               $service);
       } catch (Throwable $e) {
           try {
               if (($class = $param->getClass())) {
                   return $this->resolve($class->name, $service);
               }
           } catch (Throwable $e) {
               throw new NoFoundException(
                   "Can't get arg: " . $param . ".." . $e->getMessage());
           }
       }
   }

   /**
    * Resolve service
    * 
    * @param string $id service id
    * @param ServiceContainerInterface $service service
    * @return mixed service or null
    * 
    * @throws Psr\Container\Exception\NoFoundException for no found service
    * @throws Psr\Container\Exception\ContainerException for error
    */
   public final function resolve(
       string $id,
       ServiceContainerInterface $service = null)
   {
       try {
           if (null !== $service && $service->has($id)) {
               return $service->get($id);
           }
           $args = [];
           $reflexion = $this->getReflection($id);
           $docComment = $reflexion->getConstructor()->getDocComment();
           foreach ($reflexion->getConstructor()->getParameters() as &$param) {
                   $args[] = $this->getArg($param, $docComment, $service);
           }
           $instance = $reflexion->newInstanceArgs($args);
           if (null !== $service ) {
               $service->set($id, $instance);
           }
           return $instance;
       } catch (NoFoundException $e) {
           throw new NoFoundException(
               "Can't resolve : no found " . $id . ": " . $e->getMessage());
       } catch (Throwable $e) {
           throw new ContainerException(
               "Can't resolve : error for " . $id . ": " . $e->getMessage());
       }
   }

   /**
    * Get reflexion class
    *
    * @param string $id service id
    * @return ReflectionClass
    *
    * @throws Psr\Container\Exception\NoFoundException for no found service
    * @throws Psr\Container\Exception\ContainerException for error
    */
   public final function getReflection(string $id): ReflectionClass
   {
       try {
           $reflexion = new ReflectionClass($id);
       } catch (ReflectionException $e) {
           throw new NoFoundException(
               "Can't get reflection: class no found " . $id);
       }
       if (!$reflexion->isInstantiable()) {
           throw new ContainerException(
               "Can't get reflection : " . $id . " must be instanciable");
       }
       return $reflexion;
   }

}
