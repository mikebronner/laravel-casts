@push ("css")
    <link
        href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
        rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
@endpush

<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
    wire:ignore
>

    @if ($label)
        <x-form-label
            :class="$labelClasses"
            :field="$name"
            :value="$label"
        />
    @endif

    <div
        {{ $attributes->only(["class"])->merge(["class" => "form-select w-full max-w-sm"]) }}
        x-data="{
            multiple: true,
            value: [{{ $selectedValues->join(', ') }}],
            livewireValue: '{{ $attributes->wire('model')->value }}' !== ''
                ? ('{{  $attributes->wire('model.defer')->value }}'.length > 0
                    ? $wire.entangle('{{ $attributes->wire('model')->value }}').defer
                    : $wire.entangle('{{ $attributes->wire('model')->value }}')
                    )
                : null,
            options: [

                @foreach ($selectOptions as $label => $optionValue)
                    {{ Js::from([ 'value' => $optionValue, 'label' => $label ]) }},
                @endforeach

            ],
            init() {
                this.$nextTick(() => {
                    let choices = new Choices(this.$refs.select, {
                        allowHTML: true,
                        removeItemButton: true,
                    })

                    let refreshChoices = () => {
                        let selection = this.multiple
                            ? this.value
                            : [this.value]

                        choices.clearStore()
                        choices.setChoices(this.options.map(({ value, label }) => ({
                            value,
                            label,
                            selected: selection.includes(value),
                        })))
                    }

                    refreshChoices()

                    this.$refs.select.addEventListener('change', () => {
                        this.value = choices.getValue(true);
                        this.livewireValue = this.value;
                    })

                    this.$watch('value', () => refreshChoices())
                    this.$watch('options', () => refreshChoices())
                })
            }
        }"
    >
        <select
            :multiple="multiple"
            x-ref="select"
        ></select>
    </div>

    @error($nameInDotNotation)
        <p
            class="mt-1 text-sm text-red-600"
        >
            {{ str_replace($nameInDotNotation, "'{$label}'", $message) }}
        </p>
    @enderror

    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
</x-form-group>
