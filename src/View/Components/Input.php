<?php

namespace GeneaLabs\LaravelCasts\View\Components;

abstract class Input extends BaseComponent
{
    public function __construct(
        string $name,
        string $value = null,
        string $labelClasses = "",
        string $groupClasses = "",
        string $label = null
    ) {
        parent::__construct($name, $value, $label, $labelClasses, $groupClasses);
    }
}
