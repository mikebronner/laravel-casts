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
                this.value = parseInt(this.$refs.display.value * 100);
            }
        }"
        x-init="$nextTick(function () {
            $refs.display.value = parseFloat(value / 100)
                .toLocaleString('us', {
                    minimumFractionDigits: {{ $decimals }},
                    maximumFractionDigits: {{ $decimals }}
                });
        })"
        class="relative"
    >
        <div class="pl-3 absolute inset-y-0 left-0 flex items-center pointer-events-none">
            <span class="text-gray-500 sm:text-sm">
                {{ $symbol }}
            </span>
        </div>
        <input
            x-model="value"
            id="{{ $name }}"
            name="{{ $name }}"
            type="hidden"
            value="{{ $value }}"
        />
        <input
            x-on:change="updateValue"
            x-on:keyup="updateValue"
            x-ref="display"
            {{ $attributes->merge(["class" => "form-input pl-7 pr-12"])->whereDoesntStartWith(['x-', 'wire:']) }}
            aria-describedby="price-currency"
            type="text"
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
