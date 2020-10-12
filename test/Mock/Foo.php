<?php

namespace Seeren\Container\Test\Mock;

class Foo
{

    /**
     * @param string $typed
     * @param Bar $implementation
     * @param BarInterface $interface
     * @param $notTyped
     * @param null $optional
     */
    public function __construct(
        string $typed,
        Bar $implementation,
        BarInterface $interface,
        $notTyped,
        $optional = null)
    {
    }

}
