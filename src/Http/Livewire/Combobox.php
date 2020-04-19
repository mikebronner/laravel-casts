<?php

namespace GeneaLabs\LaravelCasts\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Livewire\Component;

class Combobox extends Component
{
    protected $listeners = [
        'setErrors' => 'setErrors',
        'updateSelectedItem' => 'updateSelectedItem',
    ];

    public $createFormIsVisible = false;
    public $createFormUrl;
    public $createFormView;
    public $errors = [];
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
        string $createFormUrl = "",
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
        $this->createFormUrl = $createFormUrl ?: "";
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

        if ($this->errors["errors"] ?? false) {
            $messageBag = new MessageBag();

            foreach ($this->errors["errors"] ?? [] as $key => $message) {
                $messageBag->add($key, $message[0]);
            }

            session(["customErrors" => $messageBag]);
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

    public function cancelForm() : void
    {
        $this->createFormIsVisible = false;
        $this->search = "";
    }

    public function setErrors(array $errors = []) : void
    {
        $this->errors = $errors;
    }

    public function updateSelectedItem(array $data = []) : void
    {
        $model = null;

        if ($this->model) {
            $model = new $this->model;
        }

        if ($this->query) {
            eval("\$query = {$this->query};");
            $model = $query->getModel();
        }

        if (! $model) {
            return;
        }

        $this->selectedValue = $data[$this->valueField];
        $this->search = (new $model)
            ->find($this->selectedValue)
            ->{$this->labelField};
        $this->createFormIsVisible = false;
    }
}
