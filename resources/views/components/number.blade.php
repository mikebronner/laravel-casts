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

    <input
        {{ $attributes->merge(["class" => "form-input"]) }}
        type="number"
        name="{{ $name }}"
        value="{{ $value }}"
    >
</x-form-group>
