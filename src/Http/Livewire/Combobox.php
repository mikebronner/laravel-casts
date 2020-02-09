<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Combobox extends Component
{
    public $createFormView;
    public $createFormIsVisible = false;
    public $fieldName;
    public $label;
    public $labelField;
    public $model;
    public $placeholder = "Search ...";
    public $search;
    public $selectedValue;
    public $valueField;

    public function mount(
        string $label,
        string $fieldName,
        string $labelField,
        string $model,
        string $valueField,
        string $placeholder = "",
        string $createFormView = ""
    ) : void {
        $this->createFormView = $createFormView;
        $this->fieldName = $fieldName;
        $this->label = $label;
        $this->labelField = $labelField;
        $this->model = $model;
        $this->valueField = $valueField;

        if ($placeholder) {
            $this->placeholder = $placeholder;
        }
    }

    public function render()
    {
        $results = collect();

        if ($this->search && ! $this->selectedValue) {
            $results = (new $this->model)
                ->where($this->labelField, "LIKE", "%{$this->search}%")
                ->orderBy($this->labelField)
                ->get();
        }

        return view('genealabs-laravel-casts:livewire.combobox')
            ->with([
                "results" => $results,
            ]);
    }

    public function resetSearch() : void
    {
        $this->selectedValue = null;
    }

    public function select(string $value, string $search) : void
    {
        $this->search = $search;
        $this->selectedValue = $value;
    }

    public function showCreateForm() : void
    {
        $this->createFormIsVisible = true;
    }
}
