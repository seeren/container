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
     * @param string $message
     * @param int $code
     * @param Exception $previous
     */
    public function __construct(string $message, int $code = E_WARNING, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
