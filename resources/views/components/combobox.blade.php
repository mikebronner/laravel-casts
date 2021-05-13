<x-form-group
    {{ $attributes->only(['x-show', 'x-if', 'wire:change', 'wire:model']) }}
    :class="$groupClasses"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    @livewire("laravel-forms::combobox", [
        "componentAttributes" => $attributes->except(["wire:change", "wire:model"])->getAttributes(),
        "fieldName" => $name,
        "labelField" => $labelField,
        "searchField" => $searchField,
        "model" => $model,
        "optionField" => $optionField,
        "valueField" => $valueField,
        "placeholder" => $placeholder,
        "createFormView" => $createFromView,
        "createFormUrl" => $createFromUrl,
        "query" => $query,
        "value" => $value
    ], "combobox-{$uniqueId}")

    @error($nameInDotNotation)
        <p class="mt-1 text-red-600 text-sm">
            {{ str_replace($nameInDotNotation, "'{$label}'", $message) }}
        </p>
    @enderror

    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</x-form-group>
