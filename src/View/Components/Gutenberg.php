<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Gutenberg extends Textarea
{
    public function __construct(
        string $name,
        string $value = null,
        string $labelClasses = "",
        string $groupClasses = "",
        string $label = null
    ) {
        parent::__construct($name, $value, $labelClasses, $groupClasses, $label);
    }
}
