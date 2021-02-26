<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Exception;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use ReflectionClass;

abstract class BaseComponent extends Component
{
    public $errors;
    public $name;
    public $value;
    public $label;
    public $labelClasses;
    public $groupClasses;
    public $errorClasses;

    public function __construct(
        string $name,
        string $value = null,
        string $label = null,
        string $labelClasses = "",
        string $groupClasses = "",
        string $errorClasses = "",
        string $helpClasses = "",
        string $helpText = ""
    ) {
        $this->name = $name;
        $nameInDotNotation = trim(str_replace("[", ".", str_replace("]", "", $this->name)), ".");
        $this->value = $value
            ?: old($nameInDotNotation)
            ?: data_get(session("form-model"), $nameInDotNotation)
            ?: "";
        $this->label = $label
            ?? ucwords(str_replace("_id", " ", str_replace("_", " ", str_replace(".", " ", $this->name))));
        $this->errors = session("errors", new MessageBag)
            ->get($nameInDotNotation);
        $this->errors = collect($this->errors)
            ->map(function ($errorMessage) {
                return str_replace($this->name, "'{$this->label}'", $errorMessage);
            })
            ->toArray();

        $this->labelClasses = $labelClasses;
        $this->groupClasses = $groupClasses;
        $this->errorClasses = $errorClasses;
        $this->helpClasses = $helpClasses;
        $this->helpText = $helpText;
    }

    public function render()
    {
        $componentName = Str::slug((new ReflectionClass($this))->getShortName());

        return view("laravel-forms::components.{$componentName}");
    }
}
