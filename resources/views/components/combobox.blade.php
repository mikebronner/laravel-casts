<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            :class="$labelClasses"
        />
    @endif

    <input
        {{ $attributes->merge(["class" => "form-select"])->except(['x-show', 'x-if']) }}
        type="text"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        list="{{ $name }}-list"
    >
    <datalist
        id="{{ $name }}-list"
    >

        @foreach ($selectOptions ?? [] as $option)
            <option value="{{ $option }}">
        @endforeach

    </datalist>

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
