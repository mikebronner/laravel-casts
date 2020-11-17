<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Button extends BaseComponent
{
    public function __construct(
        string $value,
        string $name = ""
    ) {
        parent::__construct($name, $value);
    }
}
