<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        {{ $attributes }}
        type="hidden"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
    >
</x-form-group>
