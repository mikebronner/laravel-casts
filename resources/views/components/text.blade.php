<x-form-group
    :class="$groupClasses"
    :errors="$errors"
    :helpText="$helpText"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            :class="$labelClasses"
        />
    @endif

    <input
        {{ $attributes->merge(["class" => "form-input"]) }}
        type="text"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
    >
</x-form-group>
