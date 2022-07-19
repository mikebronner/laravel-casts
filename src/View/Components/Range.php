<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Range extends BaseComponent
{
    public int $minimum = 1;
    public int $maximum = 1;
    public int $step = 1;

    public function __construct(
        string $name,
        string $value = null,
        string $label = null,
        string $labelClasses = "",
        string $groupClasses = "",
        string $errorClasses = "",
        string $helpClasses = "",
        string $helpText = "",
        int $maximum = 10,
        int $minimum = 1,
        int $step = 1,
    ) {
        $this->minimum = $minimum;
        $this->maximum = $maximum;
        $this->step = $step;

        if ($value === null) {
            $value = $this->minimum
                ?? 0;
        }

        parent::__construct($name, $value, $label, $labelClasses, $groupClasses, $errorClasses, $helpClasses, $helpText);
    }
}
