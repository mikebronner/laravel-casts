<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
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

    <textarea
        {{ $attributes->except(['x-show', 'x-if']) }}
        name="{{ $name }}"
    >{{ $value }}</textarea>
</x-form-group>
