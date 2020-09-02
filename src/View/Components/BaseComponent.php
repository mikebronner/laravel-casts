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

    protected $fieldAttributes;
    protected $options;

    public function __construct(
        string $name,
        string $value = "",
        array $fieldAttributes = [],
        array $options = []
    ) {
        $this->errors = session("errors", new MessageBag)
            ->get($name);
        $this->fieldAttributes = $fieldAttributes;
        $this->name = $name;
        $this->options = $options;
        $this->value = $value;
        $this->label = $options["label"]
            ?? ucwords(str_replace("_id", " ", str_replace("_", " ", $name)));
        $this->labelClasses = $options["labelClasses"]
            ?? "";
        $this->groupClasses = $options["groupClasses"]
            ?? "";

        $this->handle();
    }

    public function handle() : void
    {
        //
    }

    public function render()
    {
        $fieldAttributes = "";

        foreach ($this->fieldAttributes as $attribute => $parameter) {
            $fieldAttributes .= " {$attribute}=\"$parameter\"";
        }

        $fieldAttributes = trim($fieldAttributes);
        $componentName = Str::slug((new ReflectionClass($this))->getShortName());

        return view("laravel-forms::components.{$componentName}")
            ->with(compact("fieldAttributes"));
    }
}
