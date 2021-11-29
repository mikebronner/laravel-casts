<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCasts\View\Components;

class TinyMce extends Textarea
{
    public $uploadPath;

    public function __construct(
        string $name,
        ?string $value = null,
        ?string $labelClasses = "",
        ?string $groupClasses = "",
        ?string $errorClasses = "",
        ?string $label = null,
        ?string $helpClasses = "",
        ?string $helpText = "",
        ?string $uploadPath = "",
    ) {
        $this->uploadPath = $uploadPath;

        parent::__construct($name, $value, $label, $labelClasses, $groupClasses, $errorClasses, $helpClasses, $helpText);
    }
}
