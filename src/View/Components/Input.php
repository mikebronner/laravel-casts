<?php

namespace GeneaLabs\LaravelCasts\View\Components;

abstract class Input extends BaseComponent
{
    public function handle() : void
    {
        $class = $this->fieldAttributes["class"]
            ?? "";

        $class = "form-input {$class}";
        $this->fieldAttributes["class"] = $class;
    }
}
