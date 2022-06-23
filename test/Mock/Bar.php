<?php

namespace Seeren\Container\Test\Mock;

class Bar implements BarInterface
{

    public function __construct(Baz $baz,string $typed = "")
    {
        unset($baz);
        unset($typed);
    }

}
