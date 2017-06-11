<?php

/**
 * This file contain Seeren\Container\Exception\NotFoundException class
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @copyright (c) Cyril Ichti <consultant@seeren.fr>
 * @link http://www.seeren.fr/ Seeren
 * @version 1.1.3
 */

namespace Seeren\Container\Exception;

use Psr\Container\NotFoundExceptionInterface as PsrNotFoundException;
use Exception;

/**
 * Class for represent a no found container exception
 * 
 * @category Seeren
 * @package Container
 * @subpackage Exception
 */
class NotFoundException extends Exception implements PsrNotFoundException
{

   /**
    * Construct NotFoundException
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
