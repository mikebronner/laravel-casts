<x-form-label
    {{ $attributes->only(["x-show", "x-if"]) }}
    :field="$name"
    :value="$label"
    :class="$labelClasses"
>
    <input
        {{ $attributes->merge(['class' => 'form-checkbox'])->except(["x-show", "x-if"]) }}
        x-data
        x-ref="input"
        x-on:change="$dispatch('input', this.value)"
        id="{{ $name }}"
        type="checkbox"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $checked }}
        wire:ignore
    >
</x-form-label>
