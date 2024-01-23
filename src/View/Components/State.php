<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use DougSisk\CountryState\CountryState;
use Illuminate\Support\Collection;

class State extends Select
{
    public function __construct(
        string $name,
        Collection $selectedValues = null,
        bool $isMultiSelect = false,
        string $labelClasses = "",
        string $groupClasses = "",
        string $errorClasses = "",
        string $helpClasses = "",
        string $helpText = "",
        string $label = null,
        string $placeholder = "",
        string $value = "",
        string $countryCode = "US",
    ) {
        parent::__construct(
            $name,
            collect((new CountryState)->getStates($countryCode))->flip(),
            $selectedValues,
            $isMultiSelect,
            $labelClasses,
            $groupClasses,
            $errorClasses,
            $helpClasses,
            $helpText,
            $label,
            $placeholder,
            $value,
        );
    }
}
