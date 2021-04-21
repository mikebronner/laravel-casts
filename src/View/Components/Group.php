<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Group extends Component
{
    public function render(): View
    {
        return view("laravel-forms::components.group");
    }
}
