@if ($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

@livewire ("genealabs-laravel-casts::combobox", [
    "label" => $options["label"] ?? "",
    "fieldName" => $name,
    "labelField" => $options["labelField"] ?? "name",
    "searchField" => $options["searchField"] ?? "name",
    "model" => $options["model"] ?? "",
    "valueField" => $options["valueField"] ?? "id",
    "placeholder" => $options["placeholder"] ?? "",
    "createFormView" => $options["createFormView"] ?? "",
    "createFormUrl" => $options["createFormUrl"] ?? "",
    "query" => $options["query"] ?? "",
    "value" => $value ?? null
])

{{-- @if (! $errors->isEmpty() && ! $errors->has($name))
    <span id="inputSuccess2Status" class="sr-only">(success)</span>
@endif --}}

@if (! $errors->isEmpty() && $errors->has($name))
    {{-- <span id="inputError2Status" class="sr-only">(error)</span> --}}
    <span class="text-sm text-red-600 italic">{{ implode(' ', $errors->get($name)) }}</span>
@endif

@if ($isHorizontal)
    </div>
@endif

@if ($options['subFormAction'] ?? false)
    @subform ($options)
@endif
