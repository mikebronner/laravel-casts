<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
    :errors="$errors"
    :helpText="$helpText"
>
    <input
        {{ $attributes->except(['x-show', 'x-if']) }}
        type="hidden"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
    >
</x-form-group>
