<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Group extends Component
{
    public array $errors;
    public string $helpText;

    public function __construct(
        array $errors = [],
        string $helpText = "",
    ) {
        $this->errors = $errors;
        $this->helpText = $helpText;
    }

    public function render(): View
    {
        return view("laravel-forms::components.group");
    }
}
