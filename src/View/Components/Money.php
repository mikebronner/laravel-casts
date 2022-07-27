<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCasts\View\Components;

class Money extends Input
{
    public string $code = "USD";
    public int $decimals = 2;
    public string $symbol = "\$";

    public function __construct(
        string $name,
        ?string $code = "USD",
        ?int $decimals = 2,
        ?string $symbol = "\$",
        ?string $value = null,
        ?string $labelClasses = "",
        ?string $groupClasses = "",
        ?string $errorClasses = "",
        ?string $helpClasses = "",
        ?string $helpText = "",
        ?string $label = null,
    ) {
        $this->code = $code;
        $this->decimals = $decimals;
        $this->symbol = $symbol;
        $value = $value
            ? number_format(intval($value) / 100, $decimals)
            : null;

        parent::__construct(
            $name,
            $value,
            $labelClasses,
            $groupClasses,
            $errorClasses,
            $helpClasses,
            $helpText,
            $label,
        );
    }
}
