<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Database\Eloquent\Model;

class Checkbox extends BaseComponent
{
    public $checked = "";

    public function __construct(
        string $name,
        string $value = "",
        bool $isChecked = false,
        array $fieldAttributes = [],
        array $options = [],
        Model $model = null
    ) {
        parent::__construct($name, $value, $fieldAttributes, $options);

        // TODO: get model from Form component
        if ($isChecked
            || ($model && $model->$name === $value)
        ) {
            $this->checked = "checked";
        }
    }

    public function handle() : void
    {
        $class = $this->fieldAttributes["class"]
            ?? "";

        $class = "form-checkbox {$class}";
        $this->fieldAttributes["class"] = $class;
    }
}
