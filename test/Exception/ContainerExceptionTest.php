<?php

namespace Seeren\Container\Test\Exception;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Seeren\Container\Exception\ContainerException;

class ContainerExceptionTest extends TestCase
{

    /**
     * @covers \Seeren\Container\Exception\ContainerException::__construct
     */
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(
            ContainerExceptionInterface::class,
            $this->createMock(ContainerException::class)
        );
    }

}
