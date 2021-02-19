<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Support\Collection;

class Select extends BaseComponent
{
    public $isMultiSelect;
    public $name;
    public $selectOptions;
    public $placeholder;
    public $selectedValues;

    public function __construct(
        string $name,
        Collection $options = null,
        Collection $selectedValues = null,
        bool $isMultiSelect = false,
        string $labelClasses = "",
        string $groupClasses = "",
        string $helpClasses = "",
        string $helpText = "",
        string $label = null,
        string $placeholder = ""
    ) {
        parent::__construct($name, null, $label, $labelClasses, $groupClasses, $helpClasses, $helpText);

        $this->name = $name;
        $this->selectOptions = $options
            ?? collect();
        $this->placeholder = $this->selectOptions->isEmpty()
            ? "No Options Available"
            : ($placeholder
                ?: "Select ...");
        $this->isMultiSelect = $isMultiSelect;
        $this->selectedValues = $selectedValues
            ?? collect();
    }
}
