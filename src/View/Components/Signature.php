<?php

namespace GeneaLabs\LaravelCasts\View\Components;

class Signature extends BaseComponent
{
    public string $clearButtonText = "Clear";

    public function __construct(
        string $name,
        ?string $value = null,
        ?string $labelClasses = "",
        ?string $groupClasses = "",
        ?string $errorClasses = "",
        ?string $helpClasses = "",
        ?string $helpText = "",
        ?string $label = null,
        ?string $clearButtonText = "",
    ) {
        parent::__construct($name, $value, $label, $labelClasses, $groupClasses, $errorClasses, $helpClasses, $helpText);

        if ($clearButtonText) {
            $this->clearButtonText = $clearButtonText;
        }
    }
}
