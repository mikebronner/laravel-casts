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
        string $name,
        Collection $options = null,
        Collection $selectedValues = null,
        bool $isMultiSelect = false,
        string $labelClasses = "",
        string $groupClasses = "",
        string $label = null,
        string $placeholder = "No Options Available"
    ) {
        parent::__construct($name, null, [], $label, $labelClasses, $groupClasses);

        $this->name = $name;
        $this->options = $options
            ?? collect();
        //     dd($this->attributes);
        $this->placeholder = $placeholder;
        $this->isMultiSelect = $isMultiSelect;
        $this->selectedValues = $selectedValues
            ?? collect();
    }
}
