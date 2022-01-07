<?php

namespace Seeren\Container\Test\Mock;

class Foo
{

    public function __construct(
        string $typed,
        Bar $implementation,
        BarInterface $interface,
        $notTyped,
        $optional = null)
    {
        unset($typed);
        unset($implementation);
        unset($interface);
        unset($notTyped);
        unset($optional);
    }

    public function show(
        $id,
        Bar $implementation
    ): int
    {
        unset($implementation);
        return $id;
    }

}
