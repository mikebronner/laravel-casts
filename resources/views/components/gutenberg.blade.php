<x-form-group
    x-data="{}"
    x-init="Laraberg.init('{{ $name }}');"
    :class="$groupClasses"
    :errors="$errors"
    :helpText="$helpText"
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
            x-on:change="$dispatch('input', $event.target.value)"
            {{ $attributes }}
            :id="$name"
            :name="$name"
            :value="$value"
            :label="$label"
            hidden="true"
        />
    </div>
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
