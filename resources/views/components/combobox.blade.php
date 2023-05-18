@props([
    "isMultiSelect",
    "canCreateValues",
    "name",
    "placeholder",
    "selectedValues",
    "selectOptions",
])

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

    <!--
        Notice: We have to use jQuery 3.5.1 instead of 3.6.0 because select2's
        input field won't autofocus on open in that version for this reason:
        https://github.com/select2/select2/issues/5993
    -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div
        x-data="{
            canCreateValues: {{ ($canCreateValues ?? false) ? 'true' : 'false' }},
            {{-- multiple: {{ ($isMultiSelect ?? false) ? 'true' : 'false' }}, --}}
            multiple: true,
            name: '{{ $name }}',
            value: ['{{ ($selectedValues->join('\', \'')) }}'],
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
            select2: null,

            init() {
                if (this.livewireValue) {
                    this.value = Object.keys(this.livewireValue).map(key => this.livewireValue[key]);
                }

                let self = this;
                let bootSelect2 = () => {
                    let selections = this.multiple
                        ? this.value
                        : [this.value]

                    self.select2 = $(this.$refs.select).select2({
                        closeOnSelect: false,
                        multiple: this.multiple,
                        tags: this.canCreateValues,
                        tokenSeparators: [',', ' '],
                        search: '',
                        data: this.options.map(i => ({
                            id: i.value,
                            text: i.label,
                            selected: selections.map(i => String(i)).includes(String(i.value)),
                        })),
                    })
                }

                let refreshSelect2 = () => {
                    self.$refs['combobox-' + self.name + '-wrapper']
                        .querySelector('textarea')
                        .value = '';
                }

                bootSelect2()

                $(this.$refs.select).on('change', () => {
                    let self = this;
                    let currentSelection = $(this.$refs.select).select2('data')

                    this.value = this.multiple
                        ? currentSelection.map(i => i.id)
                        : currentSelection[0].id
                    this.livewireValue = this.value;
                })

                this.$watch('canCreateValues', () => refreshSelect2())
                this.$watch('value', function (newValue, oldValue) {
                    let value = self.multiple
                        ? _.difference(newValue, oldValue)[0] || null
                        : newValue;

                    if (
                        self.canCreateValues === true
                        && value !== null
                        && _.find(self.options, {value: value}) === undefined
                    ) {
                        self.options.push({value: value});
                    }

                    return refreshSelect2();
                });
                this.$watch('options', function () {
                    return refreshSelect2();
                });
            },
        }"
        x-ref="combobox-{{ $name }}-wrapper"
    >
        <select
            :multiple="multiple"
            class="w-full"
            name="{{ $name }}"
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
