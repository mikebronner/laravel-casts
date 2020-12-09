<?php

namespace GeneaLabs\LaravelCasts\View\Components;

use Illuminate\Database\Eloquent\Model;

class Form extends BaseComponent
{
    public $action;
    public $autocomplete;
    public $class;
    public $enctype;
    public $framework;
    public $method;
    public $model;
    public $target;
    public $novalidate;

    public function __construct(
        string $action = "",
        string $autocomplete = "",
        string $class = "",
        string $enctype = "",
        string $framework = "",
        string $method = "",
        Model $model = null,
        bool $novalidate = false,
        string $target = ""
    ) {
        parent::__construct("", "", []);

        $this->action = $action;
        $this->autocomplete = $autocomplete
            ?: "on";
        $this->class = $class;
        $this->enctype = $enctype
            ?: "multipart/form-data";
        $this->framework = $framework
            ?? config("laravel-forms.framework")
            ?? "tailwindcss";
        $this->method = $method
            ?: "POST";
        $this->model = $model;
        $this->target = $target
            ?: "_self";
        $this->novalidate = $novalidate
            ? "novalidate"
            : "";
        session(["form-model" => $this->model]);
    }
}
