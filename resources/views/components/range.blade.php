<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
>

    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <div
        x-data="{ selectedValue: '{{ $value }}' }"
        class="flex items-center"
    >
        <input
            x-model="selectedValue"
            {{ $attributes->except(['x-show', 'x-if']) }}
            type="range"
            id="{{ $name }}"
            min="{{ $minimum }}"
            max="{{ $maximum }}"
            name="{{ $name }}"
            value="{{ $value }}"
        >
        <output
            x-bind:value="selectedValue"
            class="ml-2 text-gray-400"
        ></output>
    </div>

    @error($nameInDotNotation)
        <p class="mt-1 text-red-600 text-sm">
            {{ str_replace($nameInDotNotation, "'{$label}'", $message) }}
        </p>
    @enderror

    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</x-form-group>
