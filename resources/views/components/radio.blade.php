<input
    {{ $attributes }}
    type="radio"
    id="{{ Str::slug($name) . '-' . Str::slug($value) }}"
    name="{{ $name }}"
    value="{{ $value }}"
>

@if ($label)
    <x-form-label
        :field="Str::slug($name) . '-' . Str::slug($value)"
        :value="$label"
        class="{{ $labelClasses }}"
    />
@endif
