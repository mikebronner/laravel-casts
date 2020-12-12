<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Database\Eloquent\Model;

class Checkbox extends BaseComponent
{
    public $checked = "";
    public $labelClass = "";

    public function __construct(
        string $name,
        string $value = "",
        string $label = "",
        bool $isChecked = false,
        string $labelClasses = "",
        string $groupClasses = "",
        Model $model = null
    ) {
        parent::__construct($name, $value, [], $label, $labelClasses, $groupClasses);

        // TODO: get model from Form component
        if ($isChecked
            || ($model && $model->$name === $value)
        ) {
            $this->checked = "checked";
        }
    }
}
