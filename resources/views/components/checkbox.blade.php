<x-form-label
    {{ $attributes->whereStartsWith(['x-']) }}
    :field="trim($name, '[]') . '[' . $value . ']'"
    :value="$label"
    :class="$labelClasses"
>
    <input
        {{ $attributes->merge(['class' => 'form-checkbox'])->whereDoesntStartWith(['x-']) }}
        type="checkbox"
        @if (! $attributes->wire('model'))
        id="{{ trim($name, "[]") }}[{{ $value }}]"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $checked }}
        @endif
    >

    @error($nameInDotNotation)
        <p class="mt-1 text-sm text-red-600">
            {{ str_replace($nameInDotNotation, "'{$label}'", $message) }}
        </p>
    @enderror

    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</x-form-label>
