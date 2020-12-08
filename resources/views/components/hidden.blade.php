<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        {{ $attributes }}
        type="hidden"
        name="{{ $name }}"
        value="{{ $value }}"
    >
</x-form-group>
