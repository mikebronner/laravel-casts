<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\View\Component;

class Errors extends Component
{
    public $errorData;

    public function __construct(
        array $errorData = []
    ) {
        $this->errorData = $errorData;
    }

    public function render()
    {
        return view("laravel-forms::components.errors");
    }
}
