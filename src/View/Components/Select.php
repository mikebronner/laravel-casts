<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Support\Collection;

class Select extends BaseComponent
{
    public $isMultiSelect;
    public $name;
    public $options;
    public $placeholder;
    public $selectedValues;

    public function __construct(
        string $name = "",
        string $label = null,
        string $placeholder = "",
        Collection $options = null,
        Collection $selectedValues = null,
        bool $isMultiSelect = false,
        string $labelClasses = "",
        string $groupClasses = ""
    ) {
        $this->selectedValues = $selectedValues
            ?? collect(old($name))
            ?? collect(optional(session("form-model"))->$name)
            ?? collect();

        parent::__construct($name, "", [], $label, $labelClasses, $groupClasses);

        $this->name = $name;
        $this->options = $options
            ?? collect();
        $this->placeholder = $this->options->isEmpty()
            ? "No Options Available"
            : $placeholder;
        $this->isMultiSelect = $isMultiSelect;
    }
}
