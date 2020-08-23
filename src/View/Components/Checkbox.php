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
        array $attributes = [],
        Model $model = null
    ) {
        parent::__construct($name, $value, $attributes);
        // TODO: get model from Form component
        if ($isChecked
            || $model->$name === $value
        ) {
            $this->checked = "checked";
        }
    }
}
