<?php

namespace Seeren\Container\Test\Mock;

class Bar implements BarInterface
{

    public function __construct(Baz $baz)
    {
        unset($baz);
    }

}
