<?php

/**
 * This file contain Seeren\Container\Resolver\ResolverInterface interface
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

namespace Seeren\Container\Resolver;

use Seeren\Container\Cache\CacheInterface;

/**
 * Interface for represent a resolver
 * 
 * @category Seeren
 * @package Container
 * @subpackage Resolver
 */
interface ResolverInterface
{

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
   public function resolve(string $id, CacheInterface $cache = null);

}
