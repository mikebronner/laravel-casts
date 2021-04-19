<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Group extends Component
{
    public array $errorData;
    public string $helpText;
    public string $name;

    public function __construct(
        string $name,
        array $errorData = [],
        string $helpText = "",
    ) {
        $this->errorData = $errorData;
        $this->helpText = $helpText;
        $this->name = $name;
    }

    public function render(): View
    {
        return view("laravel-forms::components.group");
    }
}
