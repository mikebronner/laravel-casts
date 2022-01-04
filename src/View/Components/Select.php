<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Support\Collection;

class Select extends BaseComponent
{
    public bool $isMultiSelect;
    public string $name;
    public Collection $selectOptions;
    public string $placeholder;
    public Collection $selectedValues;

    public function __construct(
        string $name,
        Collection $options = null,
        Collection $selectedValues = null,
        bool $isMultiSelect = false,
        string $labelClasses = "",
        string $groupClasses = "",
        string $errorClasses = "",
        string $helpClasses = "",
        string $helpText = "",
        string $label = null,
        string $placeholder = ""
    ) {
        parent::__construct($name, null, $label, $labelClasses, $groupClasses, $errorClasses, $helpClasses, $helpText);

        $this->selectOptions = $options
            ?? collect();
        $this->placeholder = $this->selectOptions->isEmpty()
            ? "No Options Available"
            : ($placeholder
                ?: "Select ...");
        $this->isMultiSelect = $isMultiSelect;
        $this->selectedValues = $selectedValues->isEmpty()
            ? collect((string) $this->value)
            : $selectedValues;
        dump($this->selectedValues, $this->value, $this->selectOptions);
    }
}
