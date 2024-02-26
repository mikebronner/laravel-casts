@pushOnce ("css")
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0-alpha.1/dist/trix.css"></link>
    <script src="https://unpkg.com/trix@2.0.0-alpha.1/dist/trix.umd.js"></script>
    <style>
        [data-trix-button-group="file-tools"] {
            display: none !important;
        }
    </style>
@endpushOnce

<x-form-group
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
        {{ $attributes->whereStartsWith(['wire:', 'x-']) }}
        class="max-w-2xl w-full"
        x-data="{ value: '{!! $value !!}' }"
        x-id="['{{ $name }}']"
        x-init="$refs.trix.editor.loadHTML(value)"
        x-on:trix-change="value = $refs.input.value; $dispatch('input', value)"
        x-on:trix-file-accept.prevent
    >
        <input
            type="hidden"
            x-bind:id="$id('{{ $name }}')"
            x-ref="input"
        >
        <div
            wire:ignore
        >
            <trix-editor
                {{ $attributes->whereDoesntStartWith(['x-', 'wire:']) }}
                class="prose bg-white"
                x-bind:input="$id('{{ $name }}')"
                x-ref="trix"
            ></trix-editor>
        </div>
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
