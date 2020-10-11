<?php

namespace Seeren\Container\Exception;

use Psr\Container\ContainerExceptionInterface;
use Exception;

/**
 * Class to represent a generic exception in a container
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Container\Exception
 */
class ContainerException extends Exception implements ContainerExceptionInterface
{

    /**
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(string $message, int $code = E_ERROR, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
