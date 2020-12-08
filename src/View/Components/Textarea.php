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
        string $groupClasses = ""
    ) {
        $value = $value
            ?? old($name)
            ?? optional(session("form-model"))->$name
            ?? "";
        parent::__construct($name, $value ?? "");

        $this->groupClasses = $groupClasses;
        $this->labelClasses = $labelClasses;
    }
}
