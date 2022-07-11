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
        class="relative"
        x-data="{
            allowLivewireUpdates: true,
            displayValue: '',
            livewireValue: $wire.entangle('{{ $attributes->wire('model')->value }}'),
            value: '{{ $value }}',

            init: function () {
                let self = this;
                let value = this.value;

                if (this.value === '') {
                    value = this.livewireValue;
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
                let cleaned = ('' + this.value).replace(/\D/g, '');
                let match = cleaned.match(/^(1|)?(\d{3})(\d{3})(\d{4})$/);

                if (match) {
                    this.displayValue = ['(', match[2], ') ', match[3], '-', match[4]].join('');
                }
            },

            updateValue: function (dispatch) {
                this.value = ('' + this.displayValue).replace(/\D/g, '');
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
    >
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <span class="text-gray-500 sm:text-sm"> +1 </span>
        </div>
        <input
            {{ $attributes->except(['x-show', 'x-if'])->merge(['class' => 'pl-8']) }}
            name="{{ $name }}"
            placeholder="(999) 999-9999"
            type="tel"
            x-mask="(999) 999-9999"
            x-model="displayValue"
            x-on:blur="leaveField()"
            x-on:focus="enterField()"
            x-on:change="leaveField()"
            x-on:keyup="updateValue($dispatch)"
        >
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
