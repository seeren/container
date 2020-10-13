<?php

namespace Seeren\Container\Test\Mock;

class Bar implements BarInterface
{

    /**
     * @param Baz $baz
     */
    public function __construct(Baz $baz)
    {
        unset($baz);
    }

}
