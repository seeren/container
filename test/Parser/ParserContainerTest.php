<?php

namespace Seeren\Container\Test\Parser;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use Seeren\Container\Parser\ParserContainer;

class ParserContainerTest extends TestCase
{

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return __DIR__
            . DIRECTORY_SEPARATOR
            . '..'
            . DIRECTORY_SEPARATOR
            . 'config'
            . DIRECTORY_SEPARATOR
            . 'services.json';
    }

    /**
     * @param array $services
     * @return object
     *
     * @throws ContainerException
     * @throws NotFoundException
     */
    public function getParsedMock(array &$services): object
    {
        $mock = $this->createMock(ParserContainer::class);
        $mock->parse($this->getFilename(), $services);
        return $mock;
    }

    /**
     * @covers \Seeren\Container\Parser\ParserContainer::parse
     * @covers \Seeren\Container\Parser\ParserContainer::get
     * @covers \Seeren\Container\Parser\ParserContainer::has
     * @covers \Seeren\Container\Exception\ContainerException::__construct
     *
     * @throws ContainerException
     * @throws NotFoundException
     */
    public function testParseInvalid(): void
    {
        $services = [];
        $mock = $this->createMock(ParserContainer::class);
        $this->expectException(ContainerException::class);
        $mock->parse(
            __DIR__
            . DIRECTORY_SEPARATOR
            . 'config'
            . DIRECTORY_SEPARATOR
            . 'services.json',
            $services
        );
    }

    /**
     * @covers \Seeren\Container\Parser\ParserContainer::__construct
     * @covers \Seeren\Container\Parser\ParserContainer::parse
     * @covers \Seeren\Container\Parser\ParserContainer::get
     * @covers \Seeren\Container\Parser\ParserContainer::has
     */
    public function testParseAtCreation(): void
    {
        $services = [];
        (new ReflectionClass(ParserContainer::class))
            ->newInstanceArgs([$this->getFilename(), &$services]);
        $this->assertTrue([] !== $services);
    }

    /**
     * @covers \Seeren\Container\Parser\ParserContainer::parse
     * @covers \Seeren\Container\Parser\ParserContainer::get
     * @covers \Seeren\Container\Parser\ParserContainer::has
     *
     * @throws ContainerException
     * @throws NotFoundException
     */
    public function testParse(): void
    {
        $services = [];
        $this->getParsedMock($services);
        $this->assertTrue(
            'root' === $services['Seeren\Container\Dummy\Foo']['typed']
            && 'hello' === $services['Seeren\Container\Dummy\Foo']['notTyped']
        );
    }

    /**
     * @covers \Seeren\Container\Exception\NotFoundException::__construct
     * @covers \Seeren\Container\Parser\ParserContainer::parse
     * @covers \Seeren\Container\Parser\ParserContainer::get
     * @covers \Seeren\Container\Parser\ParserContainer::has
     *
     * @throws ContainerException
     * @throws NotFoundException
     */
    public function testGet(): void
    {
        $services = [];
        $mock = $this->getParsedMock($services);
        $this->expectException(NotFoundException::class);
        $mock->get('foo');
    }

}
