<?php

namespace Seeren\Container\Exception;

use Psr\Container\ContainerExceptionInterface;
use Exception;

class ContainerException extends Exception implements ContainerExceptionInterface
{

    public function __construct(string $message, int $code = E_ERROR, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
