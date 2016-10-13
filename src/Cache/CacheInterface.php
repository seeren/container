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
 * @version 1.0.1
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
     * @param string $id service id
     * @param mixed $value service value
     * @return null
     */
    public function set(string $id, $value);

   /**
    * Register service
    *
    * @param ServiceInterface $service service provider
    * @return CacheInterface self
    */
   public function register(ServiceInterface $service): self;

   /**
    * Unregister service
    *
    * @param ServiceInterface $service service provider
    * @return CacheInterface self
    */
   public function unregister(ServiceInterface $service): self;

}
