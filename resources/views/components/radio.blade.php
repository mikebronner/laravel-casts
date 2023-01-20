<input
    {{ $attributes }}
    {{ $checked }}
    id="{{ Str::slug($name) . '-' . Str::slug($value) }}"
    name="{{ $name }}"
    type="radio"
    value="{{ $value }}"
>

@if ($label)
    <x-form-label
        :field="Str::slug($name) . '-' . Str::slug($value)"
        :value="$label"
        class="{{ $labelClasses }}"
    />
@endif
