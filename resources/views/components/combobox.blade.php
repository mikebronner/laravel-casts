<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
    x-data="dropdown()"
    x-init="initialize()"
    wire:ignore
>

    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <select
        {{ $attributes->merge(["class" => "form-select"])->except(['x-show', 'x-if']) }}
        name="{{ $name }}"
        x-ref="{{ $name }}"
    >
        @if (! $attributes->get("multiple"))
            <option selected disabled value="null">{{ $placeholder }}</option>
        @endif

        @foreach ($selectOptions as $label => $optionValue)
            @if ($selectedValues->contains($optionValue))
                <option value="{{ $optionValue }}" selected>{{ $label }}</option>
            @else
                <option value="{{ $optionValue }}">{{ $label }}</option>
            @endif
        @endforeach
    </select>

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
    {{-- TODO: load only once, also add custom styling --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    {{-- TODO: load only once --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
    <script>
        function dropdown()
        {
            return {
                initialize: function () {
                    new TomSelect(this.$refs.{{ $name }}, {
                        create: false, // TODO: add create functionality to replace combobox
                    });
                },
            };
        }
    </script>
</x-form-group>
