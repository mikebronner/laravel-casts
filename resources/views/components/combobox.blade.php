<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
    x-data="dropdown()"
    x-init="initialize"
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
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        x-ref="{{ str_replace('-', '', $name) }}"
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
    <link href="https://cdn.jsdelivr.net/npm/tail.select@latest/css/default/tail.select-light.css" rel="stylesheet" type="text/css">
    {{-- TODO: load only once --}}
    <script src="https://cdn.jsdelivr.net/npm/tail.select@latest/js/tail.select.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Livewire.hook("message.processed", function (message, component) {
                tail.select(this.$refs.{{ str_replace('-', '', $name) }}, {
                    classNames: true,
                    deselect: true,
                    search: true,
                });
            });
        });

        function dropdown()
        {
            return {
                initialize: function () {
                    console.log("test");
                    tail.select(this.$refs.{{ str_replace('-', '', $name) }}, {
                        classNames: true,
                        deselect: true,
                        search: true,
                    });
                },
            };
        }
    </script>
</x-form-group>
