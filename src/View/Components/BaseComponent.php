<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use ReflectionClass;

abstract class BaseComponent extends Component
{
    public array $errorData = [];
    public string $helpText = "";
    public string $name = "";
    public string $nameInDotNotation = "";
    public $value;
    public $label;
    public $labelClasses;
    public $groupClasses;
    public $errorClasses;
    public $uniqueId;

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
        $this->uniqueId = Str::random(16);
        $this->name = $name;
        $this->nameInDotNotation = trim(str_replace("[", ".", str_replace("]", "", $this->name)), ".");
        $this->value = $value
            ?: old($this->nameInDotNotation);
        $this->value = $this->value
            ?: data_get(session("form-model"), $this->nameInDotNotation, "");
        $this->label = $label
            ?? trim(ucwords(str_replace("id", " ", str_replace("_", " ", str_replace(".", " ", $this->name)))));
        $this->errorData = session("errors", new MessageBag)
            ->get($this->nameInDotNotation);
        $this->errorData = collect($this->errorData)
            ->map(function ($errorMessage) {
                return str_replace(
                    $this->nameInDotNotation,
                    "'{$this->label}'",
                    $errorMessage,
                );
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
