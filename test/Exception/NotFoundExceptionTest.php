<?php

namespace Seeren\Container\Test\Exception;

use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;
use Seeren\Container\Exception\NotFoundException;

class NotFoundExceptionTest extends TestCase
{

    /**
     * @covers \Seeren\Container\Exception\NotFoundException::__construct
     */
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(
            NotFoundExceptionInterface::class,
            $this->createMock(NotFoundException::class)
        );
    }

}
