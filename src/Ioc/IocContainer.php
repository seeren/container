<?php

/**
 * This file contain Seeren\Container\Ioc\IocContainer class
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

use Psr\Container\ContainerInterface;
use Seeren\Container\Exception\{ContainerException, NoFoundException};
use Seeren\Container\Service\ServiceContainerInterface;

/**
 * Class for represent a ioc container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Ioc
 */
class IocContainer implements IocInterface, ContainerInterface
{

   /**
    * Construct IocContainer
    * 
    * @param IocResolverInterface $resolver resolver
    * @return null
    */
   public function __construct(IocResolverInterface $resolver)
   {
       $this->resolver = $resolver;
   }

   /**
    * Get service
    *
    * @param string $id service id
    * @return mixed service
    * @param ServiceContainerInterface $service service
    * 
    * @throws Psr\Container\Exception\ContainerException for error
    */
   public final function get($id, ServiceContainerInterface $service = null)
   {
       try {
           return $this->resolve($id, $service);
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
   public final function has($id)
   {
       return false;
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
           return $this->resolver->resolve($id, $service);
       } catch (NoFoundException $e) {
           throw $e;
       } catch (ContainerException $e) {
           throw $e;
       }
   }

}
