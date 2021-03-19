<x-form-group
    class="{{ $groupClasses }}"
    :errors="$errors"
    :helpText="$helpText"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <input
        type="email"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes }}
    >
</x-form-group>
