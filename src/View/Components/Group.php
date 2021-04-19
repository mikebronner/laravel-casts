<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Group extends Component
{
    public array $errorData;
    public string $helpText;

    public function __construct(
        array $errorData = [],
        string $helpText = "",
    ) {
        $this->errorData = $errorData;
        $this->helpText = $helpText;
    }

    public function render(): View
    {
        return view("laravel-forms::components.group");
    }
}
