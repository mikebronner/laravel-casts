<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
>
    <input
        {{ $attributes->except(['x-show', 'x-if']) }}
        type="week"
        :name="$name"
        :value="$value"
    >

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
