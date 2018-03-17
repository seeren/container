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
 * @version 1.1.3
 */

namespace Seeren\Container\Exception;

use Psr\Container\ContainerExceptionInterface as PsrContainerException;
use Exception;

/**
 * Class for represent a container exception
 * 
 * @category Seeren
 * @package Container
 * @subpackage Exception
 */
class ContainerException extends Exception implements PsrContainerException
{

   /**
    * @param string $message
    * @param int $code
    * @param Exception $previous
    */
   public function __construct(string $message, int $code = E_ERROR, Exception $previous = null)
   {
       parent::__construct($message, $code, $previous);
   }

}
