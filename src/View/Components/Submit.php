<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Submit extends BaseComponent
{
    public function __construct(string $name = '', string $value = '')
    {
        $value = $value
            ?: "Submit";

        parent::__construct($name, $value);
    }
}
