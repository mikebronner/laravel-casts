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
        string $labelClass = "",
        bool $isChecked = false,
        array $options = [],
        Model $model = null
    ) {
        parent::__construct($name, $value, $options);

        $this->labelClass = $labelClass;

        // TODO: get model from Form component
        if ($isChecked
            || ($model && $model->$name === $value)
        ) {
            $this->checked = "checked";
        }
    }
}
