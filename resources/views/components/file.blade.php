<x-form-group
    :class="$groupClasses"
    :errors="$errors"
    :helpText="$helpText"
>
    <input
        {{ $attributes }}
        type="file"
        name="{{ $name }}"
        value="{{ $value }}"
    >
</x-form-group>
