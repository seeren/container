<?php

/**
 * This file contain Seeren\Container\Service\ServiceInterface interface
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
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
    * @param CacheInterface $container cache container
    * @return ServiceInterface self
    */
   public function register(CacheInterface $container): self;

}
