<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    @if (! $isMultiSelect)
        <select
            x-cloak
            name="{{ $name }}"
            {{ $attributes }}
            x-on:change="$dispatch('input', getValue())"
        >
            @if ($placeholder)
                <option selected disabled>{{ $placeholder }}</option>
            @endif

            @foreach ($options as $label => $value)
                @if ($value === $selectedValues)
                    <option value="{{ $value }}" selected>{{ $label }}</option>
                @else
                    <option value="{{ $value }}">{{ $label }}</option>
                @endif
            @endforeach
        </select>
    @endif

    @if ($isMultiSelect)
        <div
            x-data="dropdown()"
            x-init="setOptions()"
            class="form-select focus-within:shadow-outline flex flex-col items-center mx-auto h-auto"
        >
            <div class="inline-block relative w-full">
                <div class="flex flex-col items-center relative">
                    <div x-on:click="open" class="w-full">
                        <div class="flex flex-auto flex-wrap">
                            <template
                                x-for="option in selectedOptions"
                                :key="option.index"
                            >
                                <div
                                    class="mr-2 flex justify-center items-center m-1 font-medium py-1 px-1 text-blue-800 bg-blue-100 rounded"
                                >
                                    <div
                                        class="text-xs font-normal leading-none max-w-full flex-initial"
                                        x-text="option.text"
                                    ></div>
                                    <div class="flex flex-auto flex-row-reverse ml-2">
                                        <div x-on:click.stop="remove(option, $dispatch)">
                                            <svg
                                                aria-hidden="true"
                                                focusable="false"
                                                class="fill-current w-3 h-3"
                                                role="button"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 352 512"
                                            >
                                                <path
                                                    fill="currentColor"
                                                    d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                                                ></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <input
                                class="flex-1 text-gray-400 italic font-light shadow-none outline-none"
                                placeholder="Select an option ..."
                                x-on:keyup.arrow-up="highlightPrevious()"
                                x-on:keyup.arrow-down="highlightNext()"
                                x-on:keyup.backspace="removeLast()"
                                x-on:keyup.enter="addHighlighted()"
                                x-on:keyup="filter()"
                                x-ref="input"
                            >
                        </div>
                    </div>
                </div>
                <div class="w-full px-4">
                        <div
                            x-show.transition.origin.top="isOpen()"
                            class="absolute -ml-3 shadow-md mt-3 bg-white z-40 min-w-full left-0 rounded max-h-select overflow-hidden"
                            x-on:click.away="close"
                        >
                            <div
                                x-ref="options"
                                class="flex flex-col w-full"
                            >
                                <template
                                    x-for="option in unselectedOptions"
                                    :key="option.index"
                                >
                                    <div
                                        class="cursor-pointer w-full border-gray-100 border-b hover:bg-gray-100"
                                        x-on:click="select(option, $dispatch)"
                                    >
                                        <div
                                            class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative"
                                        >
                                            <div
                                                class="w-full items-center flex justify-between"
                                            >
                                                <div
                                                    class="mx-2 leading-6"
                                                    x-text="option.text"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    @endif
</x-form-group>

@push('css')
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
@endpush

@push('js')
    <script>
        function dropdown() {
            return {
                field: document.querySelector("[name='{{ $name }}']") || {},
                filterValue: "",
                highlighted: 0,
                livewireModel: "{{ $attributes->get("wire:model") }}",
                selectedOptions: [],
                show: false,
                unselectedOptions: [],

                setOptions: function () {
                    this.unselectedOptions = this.getUnselectedOptions();
                    this.selectedOptions = this.getSelectedOptions();
                },

                getValue: function () {
                    let value = Array
                        .from(this.field.selectedOptions)
                        .map(option => option.value);

                    if (value.length === 1) {
                        value = value[0];
                    }

                    return value;
                },

                addHighlighted: function () {
                    if (this.highlighted > 0) {
                        this.$refs.options.children[this.highlighted].click();
                    }
                },

                open: function () {
                    this.show = true;
                },

                close: function () {
                    this.show = false;
                    this.highlighted = 0;
                },

                filter: function () {
                    this.filterValue = this.$refs.input.value;
                    this.setOptions();
                },

                highlightNext: function () {
                    if (this.isOpen
                        && this.$refs.options.children.length - 1 > this.highlighted
                    ) {
                        this.$refs.options.children[this.highlighted].classList.remove("bg-gray-100");
                        this.highlighted++;
                        this.$refs.options.children[this.highlighted].classList.add("bg-gray-100");
                    }
                },

                highlightPrevious: function () {
                    if (this.isOpen
                        && this.highlighted > 1
                    ) {
                        this.$refs.options.children[this.highlighted].classList.remove("bg-gray-100");
                        this.highlighted--;
                        this.$refs.options.children[this.highlighted].classList.add("bg-gray-100");
                    }
                },

                isOpen: function () {
                    return this.show === true;
                },

                removeLast: function () {
                    if (this.selectedOptions.length > 0) {
                        this.selectedOptions[this.selectedOptions.length - 1].selected = false;
                    }

                    this.setOptions();
                },

                select: function (option, dispatcher) {
                    this.field.options[option.index].setAttribute("selected", true);
                    // this.field.dispatchEvent(new Event('input'));
                    // dispatcher(this.value);

                    if (@this || false) {
                        @this.set(this.livewireModel, this.getValue());
                    }

                    this.setOptions();
                    this.$refs.input.focus();
                    this.highlighted = 0;
                },

                remove: function (option) {
                    this.field.options[option.index].removeAttribute('selected');
                    this.field.options[option.index].selected = false;

                    if (@this || false) {
                        @this.set(this.livewireModel, this.getValue());
                    }

                    this.setOptions();
                },

                getUnselectedOptions: function () {
                    let self = this;

                    return Array.from(this.field.options || []).filter(function (option) {
                        if (! self.filterValue.length) {
                            return option.selected === false;
                        }

                        return option.selected === false
                            && option.text.toLowerCase().includes(self.filterValue.toLowerCase());
                    });
                },

                getSelectedOptions: function () {
                    return Array.from(this.field.selectedOptions);
                },
            };
        }
    </script>
@endpush
