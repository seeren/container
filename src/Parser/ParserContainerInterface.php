<?php

namespace Seeren\Container\Parser;

use Psr\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use stdClass;

/**
 * Interface to represent a parser container
 *
 *     __
 *    / /__ __ __ __ __ __
 *   / // // // // // // /
 *  /_// // // // // // /
 *    /_//_//_//_//_//_/
 *
 * @package Seeren\Container\Parser
 */
interface ParserContainerInterface extends ContainerInterface
{

    /**
     * Parse services configuration file
     *
     * @param string $filename
     * @return stdClass
     *
     * @throws NotFoundExceptionInterface No parameter was found for **this** identifier
     * @throws ContainerExceptionInterface Error while parsing services
     */
    public function parse(string $filename): stdClass;

}
