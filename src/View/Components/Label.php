<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Label extends BaseComponent
{
    public $field;

    public function __construct(string $value, string $field = "")
    {
        parent::__construct("", $value);

        $this->field = $field;
    }
}
