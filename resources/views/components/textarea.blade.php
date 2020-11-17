<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <textarea
        name="{{ $name }}"
        {{ $attributes }}
    >
        {{ $value }}
    </textarea>
</x-form-group>
