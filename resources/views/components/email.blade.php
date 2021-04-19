<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    class="{{ $groupClasses }}"
    :errors="$errorData"
    :helpText="$helpText"
    :name="$name"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <input
        {{ $attributes->except(['x-show', 'x-if']) }}
        type="email"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
    >
</x-form-group>
