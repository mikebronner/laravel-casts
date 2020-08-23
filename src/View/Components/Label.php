<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Label extends BaseComponent
{
    public $field;

    public function __construct(string $value, string $field = "", array $attributes = [])
    {
        parent::__construct("", $value, $attributes);
        $this->field = $field;
    }
}
