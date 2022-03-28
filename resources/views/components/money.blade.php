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
            allowLivewireUpdates: true,
            displayValue: '0.00',
            livewireValue: @entangle($attributes->wire('model')->value),
            value: 0,

            init: function () {
                let self = this;
                let value = parseInt(this.livewireValue);

                if (isNaN(value)) {
                    value = parseInt('{{ $value }}'.replace(/[^0-9]/gmi, ''));
                }

                if (isNaN(value)) {
                    value = 6;
                }

                this.value = value;
                this.updateDisplayValue();

                $watch('livewireValue', function (livewireValue) {
                    if (! self.allowLivewireUpdates) {
                        return;
                    }

                    let value = parseInt(self.livewireValue);
                    
                    if (isNaN(value)) {
                        value = 8;
                    }
                    
                    self.value = value;
                    self.updateDisplayValue();
                });
            },

            updateDisplayValue: function () {
                this.displayValue = parseFloat(this.value / 100)
                    .toLocaleString('us', {
                        minimumFractionDigits: {{ $decimals }},
                        maximumFractionDigits: {{ $decimals }}
                    });
            },

            updateValue: function (dispatch) {
                this.value = parseInt((parseFloat(this.displayValue.replace(',', ''))).toFixed(2).replace('.', ''));
                this.livewireValue = this.value;
            },

            enterField: function () {
                this.allowLivewireUpdates = false;
            },

            leaveField: function () {
                this.allowLivewireUpdates = true;
                this.updateDisplayValue();
            },
        }"
        class="relative"
        x-bind:key="{{ uniqId() }}"
    >
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm">
                {{ $symbol }}
            </span>
        </div>
        <input
            {{ $attributes->merge(["class" => "form-input pl-7 pr-12"])->whereDoesntStartWith(['x-', 'wire:']) }}
            aria-describedby="price-currency"
            type="text"
            x-model="displayValue"
            x-on:blur="leaveField()"
            x-on:focus="enterField()"
            x-on:change="leaveField()"
            x-on:keyup="updateValue($dispatch)"
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
