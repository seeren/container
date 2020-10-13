<?php

namespace Seeren\Container\Test;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Seeren\Container\Container;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use Seeren\Container\Test\Mock\BazInterface;
use Seeren\Container\Test\Mock\Foo;

class ContainerTest extends TestCase
{

    /**
     * @return array
     */
    public function reflexionProvider(): array
    {
        return [[
            new ReflectionClass(Container::class)
        ]];
    }

    /**
     * @param ReflectionClass $reflection
     * @param string|null $filename
     * @return object
     */
    public function getMock(
        ReflectionClass $reflection,
        bool $auto = false): object
    {
        return $reflection->newInstance(!$auto
            ? __DIR__
            . DIRECTORY_SEPARATOR
            . 'config'
            . DIRECTORY_SEPARATOR
            . 'services.json'
            : null);
    }

    /**
     * @dataProvider reflexionProvider
     * @covers       \Seeren\Container\Container::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::get
     * @covers       \Seeren\Container\Parser\ParserContainer::has
     * @covers       \Seeren\Container\Parser\ParserContainer::parse
     * @param ReflectionClass $reflection
     *
     * @throws \ReflectionException
     */
    public function testConfiguration(ReflectionClass $reflection): void
    {
        $mock = $this->getMock($reflection);
        $parameter = $reflection->getProperty("services");
        $parameter->setAccessible(true);
        $this->assertTrue([] !== $parameter->getValue($mock));
    }

    /**
     * @dataProvider reflexionProvider
     * @covers       \Seeren\Container\Container::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::parse
     * @covers       \Seeren\Container\Exception\ContainerException::__construct
     * @param ReflectionClass $reflection
     */
    public function testConfigurationContainerException(ReflectionClass $reflection): void
    {
        $this->expectException(ContainerException::class);
        $this->getMock($reflection, true);
    }

    /**
     * @covers       \Seeren\Container\Container::has
     */
    public function testHasNot(): void
    {
        $mock = $this->createMock(Container::class);
        $this->assertFalse($mock->has(Foo::class));
    }

    /**
     * @dataProvider reflexionProvider
     * @covers       \Seeren\Container\Container::__construct
     * @covers       \Seeren\Container\Container::get
     * @covers       \Seeren\Container\Container::has
     * @covers       \Seeren\Container\Parser\ParserContainer::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::get
     * @covers       \Seeren\Container\Parser\ParserContainer::has
     * @covers       \Seeren\Container\Parser\ParserContainer::parse
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @covers       \Seeren\Container\Resolver\ResolverContainer::resolve
     * @param ReflectionClass $reflection
     */
    public function testHas(ReflectionClass $reflection): void
    {
        $mock = $this->getMock($reflection);
        $mock->get(Foo::class);
        $this->assertTrue($mock->has(Foo::class));
    }

    /**
     * @dataProvider reflexionProvider
     * @covers       \Seeren\Container\Container::__construct
     * @covers       \Seeren\Container\Container::get
     * @covers       \Seeren\Container\Container::has
     * @covers       \Seeren\Container\Parser\ParserContainer::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::get
     * @covers       \Seeren\Container\Parser\ParserContainer::has
     * @covers       \Seeren\Container\Parser\ParserContainer::parse
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @covers       \Seeren\Container\Exception\NotFoundException::__construct
     * @param ReflectionClass $reflection
     */
    public function testNotFoundException(ReflectionClass $reflection): void
    {
        $mock = $this->getMock($reflection);
        $this->expectException(NotFoundException::class);
        $mock->get(BazInterface::class);
    }

    /**
     * @dataProvider reflexionProvider
     * @covers       \Seeren\Container\Container::__construct
     * @covers       \Seeren\Container\Container::get
     * @covers       \Seeren\Container\Container::has
     * @covers       \Seeren\Container\Parser\ParserContainer::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::get
     * @covers       \Seeren\Container\Parser\ParserContainer::has
     * @covers       \Seeren\Container\Parser\ParserContainer::parse
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @covers       \Seeren\Container\Exception\ContainerException::__construct
     * @param ReflectionClass $reflection
     */
    public function testContainerException(ReflectionClass $reflection): void
    {
        $mock = $this->getMock($reflection);
        $this->expectException(ContainerException::class);
        $mock->get("Qux");
    }

    /**
     * @dataProvider reflexionProvider
     * @covers       \Seeren\Container\Container::__construct
     * @covers       \Seeren\Container\Container::get
     * @covers       \Seeren\Container\Container::has
     * @covers       \Seeren\Container\Parser\ParserContainer::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::get
     * @covers       \Seeren\Container\Parser\ParserContainer::has
     * @covers       \Seeren\Container\Parser\ParserContainer::parse
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @covers       \Seeren\Container\Resolver\ResolverContainer::resolve
     * @param ReflectionClass $reflection
     */
    public function testGet(ReflectionClass $reflection): void
    {
        $mock = $this->getMock($reflection);
        $this->assertEquals($mock->get(Foo::class), $mock->get(Foo::class));
    }

    /**
     * @dataProvider reflexionProvider
     * @covers       \Seeren\Container\Container::__construct
     * @covers       \Seeren\Container\Container::call
     * @covers       \Seeren\Container\Container::get
     * @covers       \Seeren\Container\Container::has
     * @covers       \Seeren\Container\Parser\ParserContainer::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::get
     * @covers       \Seeren\Container\Parser\ParserContainer::has
     * @covers       \Seeren\Container\Parser\ParserContainer::parse
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @covers       \Seeren\Container\Resolver\ResolverContainer::resolve
     * @covers       \Seeren\Container\Exception\NotFoundException::__construct
     * @param ReflectionClass $reflection
     */
    public function testCallNotFoundException(ReflectionClass $reflection): void
    {
        $mock = $this->getMock($reflection);
        $this->expectException(NotFoundException::class);
        $mock->call(Foo::class, "methodName");
    }

    /**
     * @dataProvider reflexionProvider
     * @covers       \Seeren\Container\Container::__construct
     * @covers       \Seeren\Container\Container::call
     * @covers       \Seeren\Container\Container::get
     * @covers       \Seeren\Container\Container::has
     * @covers       \Seeren\Container\Parser\ParserContainer::__construct
     * @covers       \Seeren\Container\Parser\ParserContainer::get
     * @covers       \Seeren\Container\Parser\ParserContainer::has
     * @covers       \Seeren\Container\Parser\ParserContainer::parse
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @covers       \Seeren\Container\Resolver\ResolverContainer::resolve
     * @param ReflectionClass $reflection
     */
    public function testCall(ReflectionClass $reflection): void
    {
        $mock = $this->getMock($reflection);
        $this->assertEquals(
            7,
            $mock->call(Foo::class, "show", [7])
        );
    }

}
