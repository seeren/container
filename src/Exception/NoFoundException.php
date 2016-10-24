<?php

/**
 * This file contain Seeren\Container\Exception\NoFoundException class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.1
 */

namespace Seeren\Container\Exception;

use Psr\Container\Exception\NotFoundException as PsrNotFoundException;
use Exception;

/**
 * Class for represent a no found container exception
 * 
 * @category Seeren
 * @package Container
 * @subpackage Exception
 */
class NoFoundException extends Exception implements PsrNotFoundException
{

   /**
    * Construct NoFoundException
    * 
    * @param string $message message
    * @param int $code code
    * @param Exception $previous previous exception
    * @return null
    */
   public function __construct(
       string $message,
       int $code = E_WARNING,
       Exception $previous = null)
   {
       parent::__construct($message, $code, $previous);
   }

}
