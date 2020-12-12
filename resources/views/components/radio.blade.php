<input
    {{ $attributes }}
    type="radio"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ $value }}"
>

@if ($label)
    <x-form-label
        :field="$name"
        :value="$label"
        class="{{ $labelClasses }}"
    />
@endif
