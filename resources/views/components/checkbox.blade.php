<x-form-label
    :field="$name"
    :value="$label"
    :attributes="['class' => $labelClasses]"
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
        {!! $fieldAttributes !!}
        {{ $attributes }}
        wire:ignore
    >
</x-form-label>
