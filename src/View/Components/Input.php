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
        string $groupClasses = ""
    ) {
        $value = $value
            ?? old($name)
            ?? optional(session("form-model"))->$name
            ?? "";
        parent::__construct($name, $value ?? "");

        $this->labelClasses = $labelClasses;
        $this->groupClasses = $groupClasses;
    }

    public function handle() : void
    {
        $class = $this->fieldAttributes["class"]
            ?? "";
        $class = "form-input {$class}";
        $this->fieldAttributes["class"] = $class;
    }
}
