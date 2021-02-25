<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\View\Component;

class Group extends Component
{
    public $errors;

    public function __construct(
        array $errors = []
    ) {
        $this->errors = $errors;
    }

    public function render()
    {
        return view("laravel-forms::components.group");
    }
}