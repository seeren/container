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
     * @param string $className
     * @param mixed $value
     * @return CacheInterface self
     */
    public function set(string $className, $value): self;

   /**
    * Register service
    *
    * @param ServiceInterface $service
    * @return CacheInterface self
    */
   public function register(ServiceInterface $service): self;

}
