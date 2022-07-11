<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Support\Str;

class Tel extends Input
{
    public function __construct(
        string $name,
        ?string $value = null,
        ?string $labelClasses = "",
        ?string $groupClasses = "",
        ?string $errorClasses = "",
        ?string $helpClasses = "",
        ?string $helpText = "",
        ?string $label = null,
    ) {
        $value = Str::replace("+1", "", $value);

        parent::__construct($name, $value, $label, $labelClasses ?? "", $groupClasses ?? "", $errorClasses ?? "", $helpClasses ?? "", $helpText ?? "");
    }
}
