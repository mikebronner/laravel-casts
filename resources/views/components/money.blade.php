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

    <div
        x-data="{
            value: @entangle($attributes->wire('model')),

            updateValue: function () {
                this.value = this.$refs.input.value * 100;
            }
        }"
        x-init="$nextTick(function () {
            let value = $refs.input.value;

            if (value.indexOf('.') !== false) {
                $refs.input.value = parseFloat(value / 100.0)
                    .toLocaleString('us', {
                        minimumFractionDigits: {{ $decimals }},
                        maximumFractionDigits: {{ $decimals }}
                    });
            } else {
                $refs.input.value = parseFloat(value)
                    .toLocaleString('us', {
                        minimumFractionDigits: {{ $decimals }},
                        maximumFractionDigits: {{ $decimals }}
                    });
            }
        });"
        class="relative"
    >
        <div class="pl-3 absolute inset-y-0 left-0 flex items-center pointer-events-none">
            <span class="text-gray-500 sm:text-sm">
                {{ $symbol }}
            </span>
        </div>
        <input
            x-on:change="updateValue"
            x-ref="input"
            {{ $attributes->merge(["class" => "form-input pl-7 pr-12"])->except(['x-show', 'x-if', 'wire:model']) }}
            aria-describedby="price-currency"
            id="{{ $name }}"
            name="{{ $name }}"
            type="text"
            value="{{ $value }}"
        >
        <div class="pr-3 absolute inset-y-0 right-0 flex items-center pointer-events-none">
            <span class="text-gray-500 sm:text-sm" id="price-currency">
                {{ $code }}
            </span>
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
