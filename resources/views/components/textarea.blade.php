<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
    :errorData="$errorData"
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

    <textarea
        {{ $attributes->except(['x-show', 'x-if']) }}
        name="{{ $name }}"
    >{{ $value }}</textarea>
</x-form-group>
