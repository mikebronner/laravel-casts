<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class Select extends BaseComponent
{
    public $id;
    public $isMultiSelect;
    public $name;
    public $options;
    public $placeholder;
    public $selectedValues;

    public function __construct(
        string $name = "",
        string $placeholder = "",
        Collection $options = null,
        Collection $selectedValues = null,
        bool $isMultiSelect = false
    ) {
        parent::__construct($name);

        $this->name = $name;
        $this->options = $options
            ?? collect();
        $this->selectedValues = $selectedValues
            ?? collect();
        $this->placeholder = $this->options->isEmpty()
            ? "No Options Available"
            : $placeholder;
        $this->isMultiSelect = $isMultiSelect;
        $this->id = $this->name . "-" . Str::random(12);
    }
}
