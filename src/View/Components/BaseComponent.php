<?php

namespace GeneaLabs\LaravelCasts\View\Components;

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
        $this->errors = session("errors", new MessageBag)
            ->get($name);

        $this->name = $name;
        $this->value = $value
            ?: old($name)
            ?: optional(session("form-model"))->$name
            ?: "";
        $this->label = $label
            ?? ucwords(str_replace("_id", " ", str_replace("_", " ", str_replace("[", " ", str_replace("]", " ", $name)))));
        $this->labelClasses = $labelClasses;
        $this->groupClasses = $groupClasses;
        $this->errorClasses = $errorClasses;
        $this->helpClasses = $helpClasses;
        $this->helpText = $helpText;

        $this->handle();
    }

    public function handle() : void
    {
        //
    }

    public function render()
    {
        $componentName = Str::slug((new ReflectionClass($this))->getShortName());

        return view("laravel-forms::components.{$componentName}");
    }
}
