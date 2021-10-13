<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCasts\View\Components;

class ComboboxOld extends BaseComponent
{
    public string $createFromUrl = "";
    public string $createFromView = "";
    public string $labelField = "";
    public string $model = "";
    public string $optionField = "";
    public string $placeholder = "";
    public string $query = "";
    public string $searchField = "";
    public string $valueField = "";

    public function __construct(
        string $name,
        string $createFromView = "",
        string $createFromUrl = "",
        string $errorClasses = "",
        string $groupClasses = "",
        string $helpClasses = "",
        string $helpText = "",
        string $label = null,
        string $labelClasses = "",
        string $labelField = "",
        string $model = "",
        string $optionField = "",
        string $placeholder = "",
        string $query = "",
        string $searchField = "",
        string $value = null,
        string $valueField = "",
    ) {
        parent::__construct($name, $value, $label, $labelClasses, $groupClasses, $errorClasses, $helpClasses, $helpText);

        $this->createFromUrl = $createFromUrl;
        $this->createFromView = $createFromView;
        $this->labelField = $labelField;
        $this->model = $model;
        $this->optionField = $optionField;
        $this->placeholder = $placeholder;
        $this->query = $query;
        $this->searchField = $searchField;
        $this->valueField = $valueField;
    }
}
