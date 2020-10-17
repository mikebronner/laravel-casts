<x-form-label
    :field="$name"
    :value="$label"
    class="{{ $labelClass }}"
>
    <input
        x-data
        x-ref="input"
        x-on:change="$dispatch('input', this.value)"
        id="{{ $name }}"
        type="checkbox"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $checked }}
        {{ $attributes->merge(['class' => 'form-checkbox']) }}
        wire:ignore
    >
</x-form-label>
