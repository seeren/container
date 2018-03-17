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
 * @version 1.1.1
 */

namespace Seeren\Container\Service;

use Seeren\Container\Cache\CacheInterface;

/**
 * Interface for represent a service provider
 * 
 * @category Seeren
 * @package Container
 * @subpackage Service
 */
interface ServiceInterface
{

   /**
    * Register container
    *
    * @param CacheInterface $container
    * @return ServiceInterface self
    */
   public function register(CacheInterface $container): self;

}
