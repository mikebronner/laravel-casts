<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Textarea extends BaseComponent
{
    public $labelClasses = "";
    public $groupClasses = "";

    public function __construct(
        string $name,
        string $value = null,
        string $labelClasses = "",
        string $groupClasses = "",
        string $errorClasses = "",
        string $label = null,
        string $helpClasses = "",
        string $helpText = ""
    ) {
        parent::__construct($name, $value, $label, $labelClasses, $groupClasses, $errorClasses, $helpClasses, $helpText);
    }
}
