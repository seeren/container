<?php

namespace Seeren\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;
use Exception;

/**
 * Class to represent missing entry in the container
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Container\Exception
 */
class NotFoundException extends Exception implements NotFoundExceptionInterface
{

    /**
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(string $message, int $code = E_WARNING, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
