<?php

namespace GeneaLabs\LaravelCasts\Http\Livewire;

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
    public $query;
    public $search;
    public $selectedValue;
    public $valueField;

    public function mount(
        string $label = "",
        string $fieldName = "",
        string $labelField = "",
        string $model = "",
        string $valueField = "id",
        string $placeholder = "",
        string $createFormView = "",
        string $query = ""
    ) : void {
        $this->createFormView = $createFormView ?: "";
        $this->fieldName = $fieldName ?: "";
        $this->label = $label ?: "";
        $this->labelField = $labelField ?: "";
        $this->model = $model ?: "";
        $this->valueField = $valueField ?: "id";
        $this->query = $query ?: "";

        if ($placeholder) {
            $this->placeholder = $placeholder;
        }
    }

    public function render()
    {
        $results = collect();

        if ($this->search && ! $this->selectedValue) {
            $query = "";

            if ($this->model) {
                $query = (new $this->model);
            }

            if ($this->query) {
                eval("\$query = {$this->query};");
            }
        
            if ($query) {
                $results = $query
                    ->where($this->labelField, "ILIKE", "%{$this->search}%")
                    ->orderBy($this->labelField)
                    ->get();
            }
        }

        return view('genealabs-laravel-casts::livewire.combobox')
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
