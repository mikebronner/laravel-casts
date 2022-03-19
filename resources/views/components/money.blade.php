<x-form-group
    {{ $attributes->whereStartsWith(['x-show', 'x-if']) }}
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

            updateDisplay: function () {
                this.value = this.$wire.get('{{ $attributes->wire('model')->value() }}');
                this.$refs.valueField.value = this.value;
                this.$refs.moneyField.value = parseFloat(this.$refs.valueField.value / 100)
                    .toLocaleString('us', {
                        minimumFractionDigits: {{ $decimals }},
                        maximumFractionDigits: {{ $decimals }}
                    });
            },

            updateValue: function (dispatch) {
                let value = (this.$refs.moneyField.value.replace(/[a-z,]/gi, '') || 0);
                value = parseInt(parseFloat(value).toFixed(2).replace('.', ''));
                this.$refs.valueField.value = value;
                this.$wire.set('{{ $attributes->wire('model')->value() }}', value);
            },
        }"
        x-init="
            $watch('value', function (value) {
                updateDisplay();
            });
        "
        class="relative"
    >
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm">
                {{ $symbol }}
            </span>
        </div>
        <input
            {{ $attributes->whereStartsWith(['wire:model']) }}
            id="{{ $name }}"
            name="{{ $name }}"
            type="hidden"
            x-ref="valueField"
            @if ($value)
            value="{{ $value }}"
            @endif
        />
        <input
            {{ $attributes->merge(["class" => "form-input pl-7 pr-12"])->whereDoesntStartWith(['x-', 'wire:']) }}
            aria-describedby="price-currency"
            type="number"
            onkeypress="return /[\d.,]/.test(String.fromCharCode(event.keyCode || event.which))"
            x-ref="moneyField"
        >
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
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
