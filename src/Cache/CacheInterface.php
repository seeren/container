<?php

/**
 * This file contain Seeren\Container\Cache\CacheInterface interface
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

namespace Seeren\Container\Cache;

use Seeren\Container\Service\ServiceInterface;

/**
 * Interface for represent a cache container
 * 
 * @category Seeren
 * @package Container
 * @subpackage Cache
 */
interface CacheInterface
{

    /**
     * Set service
     *
     * @param string $className service id
     * @param mixed $value service value
    * @return CacheInterface self
     */
    public function set(string $className, $value): self;

   /**
    * Register service
    *
    * @param ServiceInterface $service service provider
    * @return CacheInterface self
    */
   public function register(ServiceInterface $service): self;

}
