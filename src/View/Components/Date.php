<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Throwable;
use Illuminate\Support\Carbon;

class Date extends BaseComponent
{
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
        parent::__construct($name, $value, $label, $labelClasses, $groupClasses, $errorClasses, $helpClasses, $helpText);

        if ($this->value) {
            if (! $this->value instanceof Carbon) {
                try {
                    $this->value = (new Carbon)->make($this->value);
                } catch (Throwable) {
                    $this->value = null;
                }
            }

            $this->value = $this->value
                ?->format("Y-m-d");
        }
    }
}
