<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    x-data="{}"
    x-init="Laraberg.init('{{ $name }}');"
    :class="$groupClasses"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <div wire:ignore>
        <x-form-textarea
            {{ $attributes->except(['x-show', 'x-if']) }}
            x-on:change="$dispatch('input', $event.target.value)"
            :id="$name"
            :name="$name"
            :value="$value"
            :label="$label"
            hidden="true"
        />
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

@push ("css")
    <link
        rel="stylesheet"
        href="{{asset('vendor/laraberg/css/laraberg.css')}}"
    >
    <style>
        .laraberg__editor {
            border: 0 !important;
        }
    </style>
@endpush

@push ("css")
    <script
        src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"
    ></script>
    <script
        src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"
    ></script>
    <script
        src="{{ asset('/vendor/laraberg/js/laraberg.js') }}"
    ></script>
    <script>
        {{-- console.log("test");
        Laraberg.init("{{ $name }}"); --}}
    </script>
@endpush
