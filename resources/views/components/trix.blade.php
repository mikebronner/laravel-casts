<x-form-group
    {{ $attributes->whereStartsWith(['x-', 'wire:']) }}
    :class="$groupClasses"
>

    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <input
        id="trix-content-{{ $name }}"
        name="{{ $name }}"
        type="hidden"
        value="{{ $value }}"
    >
    <div
        wire:ignore
        x-data
        x-on:trix-blur="$dispatch('change', $event.target.value)"
    >
        <trix-editor
            {{ $attributes->whereDoesntStartWith(['x-', 'wire:']) }}
            input="trix-content-{{ $name }}"
        ></trix-editor>
    </div>

    @error($nameInDotNotation)
        <p class="mt-1 text-sm text-red-600">
            {{ str_replace($nameInDotNotation, "'{$label}'", $message) }}
        </p>
    @enderror

    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</x-form-group>
