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

    <input
        {{ $attributes->merge(["class" => "z-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-4 sm:text-sm border-gray-300"])->except(['x-show', 'x-if']) }}
        type="datetime"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
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
