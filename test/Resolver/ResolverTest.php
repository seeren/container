<?php

namespace Seeren\Container\Test\Resolver;

use PHPUnit\Framework\TestCase;
use Seeren\Container\Exception\ContainerException;
use Seeren\Container\Exception\NotFoundException;
use Seeren\Container\Parser\ParserContainer;
use Seeren\Container\Resolver\ResolverContainer;
use Seeren\Container\Test\Mock\Baz;
use Seeren\Container\Test\Mock\BazInterface;
use Seeren\Container\Test\Mock\Foo;
use Seeren\Container\Test\Mock\Qux;

class ResolverTest extends TestCase
{

    /**
     * @return \array[][]
     *
     * @throws ContainerException
     * @throws NotFoundException
     */
    public function servicesProvider(): array
    {
        $services = [];
        $parser = $this->createMock(ParserContainer::class);
        $parser->parse(
            __DIR__
            . DIRECTORY_SEPARATOR
            . '..'
            . DIRECTORY_SEPARATOR
            . 'config'
            . DIRECTORY_SEPARATOR
            . 'services.json',
            $services
        );
        return [[$services]];
    }

    /**
     * @dataProvider servicesProvider
     * @covers       \Seeren\Container\Exception\ContainerException::__construct
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @param array $services
     */
    public function testGetContainerException(array $services): void
    {
        $mock = $this->createMock(ResolverContainer::class);
        $this->expectException(ContainerException::class);
        $mock->get("Qux", $services);
    }

    /**
     * @dataProvider servicesProvider
     * @covers       \Seeren\Container\Exception\NotFoundException::__construct
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @param array $services
     */
    public function testGetNotFoundException(array $services): void
    {
        $mock = $this->createMock(ResolverContainer::class);
        $this->expectException(NotFoundException::class);
        $mock->get(BazInterface::class, $services);
    }

    /**
     * @dataProvider servicesProvider
     * @covers       \Seeren\Container\Exception\NotFoundException::__construct
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @covers       \Seeren\Container\Resolver\ResolverContainer::resolve
     * @param array $services
     */
    public function testResolveNotFoundException(array $services): void
    {
        $mock = $this->createMock(ResolverContainer::class);
        $this->expectException(NotFoundException::class);
        $mock->get(Qux::class, $services);
    }

    /**
     * @dataProvider servicesProvider
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @param array $services
     */
    public function testGetClass(array $services): void
    {
        $mock = $this->createMock(ResolverContainer::class);
        $this->assertInstanceOf(Baz::class, $mock->get(Baz::class, $services));
    }

    /**
     * @dataProvider servicesProvider
     * @covers       \Seeren\Container\Resolver\ResolverContainer::get
     * @covers       \Seeren\Container\Resolver\ResolverContainer::resolve
     * @param array $services
     */
    public function testGetService(array $services): void
    {
        $mock = $this->createMock(ResolverContainer::class);
        $this->assertInstanceOf(Foo::class, $mock->get(Foo::class, $services));
    }

    /**
     * @covers \Seeren\Container\Resolver\ResolverContainer::has
     */
    public function testHas(): void
    {
        $this->assertFalse($this->createMock(ResolverContainer::class)->has("Foo"));
    }

}
