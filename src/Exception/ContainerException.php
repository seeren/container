<?php

/**
 * This file contain Seeren\Container\Exception\ContainerException class
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

namespace Seeren\Container\Exception;

use Psr\Container\Exception\ContainerException;
use Exception;

/**
 * Class for represent a container exception
 * 
 * @category Seeren
 * @package Container
 * @subpackage Exception
 */
class ContainerException extends Exception implements ContainerException
{

   /**
    * Construct ContainerException
    * 
    * @param string $message message
    * @param int $code code
    * @param Exception $previous previous exception
    * @return null
    */
   public function __construct(
       string $message,
       int $code = E_ERROR,
       Exception $previous = null)
   {
       parent::__construct($message, $code, $previous);
   }

}
