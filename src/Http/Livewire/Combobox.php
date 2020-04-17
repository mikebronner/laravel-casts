<?php

namespace GeneaLabs\LaravelCasts\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class Combobox extends Component
{
    public $createFormIsVisible = false;
    public $createFormView;
    public $fieldName;
    public $label;
    public $labelField;
    public $model;
    public $placeholder = "Search ...";
    public $query;
    public $search;
    public $searchField;
    public $selectedValue;
    public $valueField;

    public function mount(
        string $createFormView = "",
        string $fieldName = "",
        string $label = "",
        string $labelField = "",
        string $model = "",
        string $placeholder = "",
        string $query = "",
        string $searchField = "",
        string $valueField = "id",
        $value = null
    ) : void {
        $this->createFormView = $createFormView ?: "";
        $this->fieldName = $fieldName ?: "";
        $this->label = $label ?: "";
        $this->labelField = ($labelField ?: ($searchField ?: ""));
        $this->model = $model ?: "";
        $this->query = $query ?: "";
        $this->searchField = $searchField ?: "";
        $this->valueField = $valueField ?: "id";

        if ($value) {
            $value = json_decode($value, false);
            $this->search = $value->{$this->labelField};
            $this->selectedValue = $value->{$this->valueField};
        }

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
                if ($this->searchField) {
                    if (Str::contains($this->searchField, ".")) {
                        $query = $query->whereJoin($this->searchField, "ILIKE", "%{$this->search}%")
                            ->orderByJoin($this->searchField);
                    } else {
                        // TODO: refactor out from if-else.
                        $query = $query->where($this->searchField, "ILIKE", "%{$this->search}%")
                            ->orderBy($this->searchField);
                    }
                }

                $results = $query
                    ->limit(100)
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
