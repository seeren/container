<?php

namespace Seeren\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;
use Exception;

class NotFoundException extends Exception implements NotFoundExceptionInterface
{

    public function __construct(string $message, int $code = E_WARNING, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
