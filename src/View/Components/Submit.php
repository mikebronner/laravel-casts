<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Submit extends BaseComponent
{
    public function __construct(string $name, array $attributes)
    {
        parent::__construct($name, "", $attributes);
    }
}
