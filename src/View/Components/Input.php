<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCasts\View\Components;

abstract class Input extends BaseComponent
{
    public function __construct(
        string $name,
        ?string $value = null,
        ?string $labelClasses = "",
        ?string $groupClasses = "",
        ?string $errorClasses = "",
        ?string $helpClasses = "",
        ?string $helpText = "",
        ?string $label = null
    ) {
        parent::__construct($name, $value, $label, $labelClasses, $groupClasses, $errorClasses, $helpClasses, $helpText);
    }
}
