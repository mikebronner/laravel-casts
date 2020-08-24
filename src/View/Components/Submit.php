<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Submit extends BaseComponent
{
    public function __construct(string $name = '', string $value = '', array $attributes = [])
    {
        $value = $value ?: "Submit";
        parent::__construct($name, $value, $attributes);
    }
}
