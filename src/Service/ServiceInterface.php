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
 * @version 1.0.1
 */

namespace Seeren\Container\Service;

/**
 * Interface for represent a service
 * 
 * @category Seeren
 * @package Container
 * @subpackage Service
 */
interface ServiceInterface
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
    * Remove service
    *
    * @param string $id service id
    * @return bool unset or not
    */
   public function remove(string $id): bool;

}
