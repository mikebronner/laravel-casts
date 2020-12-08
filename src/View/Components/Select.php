<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Support\Collection;

class Select extends BaseComponent
{
    public $isMultiSelect;
    public $name;
    public $label;
    public $options;
    public $placeholder;
    public $selectedValues;

    public function __construct(
        string $name = "",
        string $label = null,
        string $placeholder = "",
        Collection $options = null,
        Collection $selectedValues = null,
        bool $isMultiSelect = false
    ) {
        $this->selectedValues = $selectedValues
            ?? collect(old($name))
            ?? collect(optional(session("form-model"))->$name)
            ?? collect();
// dump($selectedValues);
        parent::__construct($name, "", [
            "label" => $label === ""
                ? " "
                : $label,
        ]);

        $this->name = $name;
        $this->label = $label;
        $this->options = $options
            ?? collect();
        $this->placeholder = $this->options->isEmpty()
            ? "No Options Available"
            : $placeholder;
        $this->isMultiSelect = $isMultiSelect;
    }
}
