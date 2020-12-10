<?php

namespace GeneaLabs\LaravelCasts\View\Components;

abstract class Input extends BaseComponent
{
    public $labelClasses = "";
    public $groupClasses = "";

    public function __construct(
        string $name,
        string $value = null,
        string $labelClasses = "",
        string $groupClasses = "",
        string $label = ""
    ) {
        $value = $value
            ?? old($name)
            ?? optional(session("form-model"))->$name
            ?? "";
        parent::__construct($name, $value ?? "", [], $label);

        $this->labelClasses = $labelClasses;
        $this->groupClasses = $groupClasses;
    }
}
