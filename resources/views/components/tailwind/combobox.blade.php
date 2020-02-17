@if ($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

@livewire ("genealabs-laravel-casts::combobox", $options["label"] ?? "", $name, $options["labelField"] ?? "name", $options["model"], $options["valueField"] ?? "id", $options["placeholder"] ?? "", $options["createForm"] ?? "")

@if (! $errors->isEmpty() && ! $errors->has($name))
    <span id="inputSuccess2Status" class="sr-only">(success)</span>
@endif

@if (! $errors->isEmpty() && $errors->has($name))
    <span id="inputError2Status" class="sr-only">(error)</span>
    <span class="text-sm text-red-600 italic">{{ implode(' ', $errors->get($name)) }}</span>
@endif

@if ($isHorizontal)
    </div>
@endif

@if ($options['subFormAction'] ?? false)
    @subform ($options)
@endif
