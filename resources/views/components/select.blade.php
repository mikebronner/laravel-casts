<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
>

    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <select
        {{ $attributes->merge(["class" => "pr-8 form-select"])->except(['x-show', 'x-if']) }}
        name="{{ $name }}"
    >
        @if (! $attributes->get("multiple"))
            <option selected disabled value="null">{{ $placeholder }}</option>
        @endif

        @foreach ($selectOptions as $label => $optionaValue)
            @if ($selectedValues->contains($optionaValue))
                <option value="{{ $optionaValue }}" selected>{{ $label }}</option>
            @else
                <option value="{{ $optionaValue }}">{{ $label }}</option>
            @endif
        @endforeach
    </select>

    @if ($isMultiSelect)
        <div
            {{ $attributes->only(["class"])->merge(["class" => "form-select relative flex flex-col items-center form-select focus-within:shadow-outline"]) }}
            x-data="dropdown{{ $uniqueId }}()"
            x-init="initialize()"
        >
                <div x-on:click="open" class="w-full">
                    <div class="relative flex items-center">
                        <template
                            x-for="option in selectedOptions"
                            :key="option.index"
                        >
                            <div
                                class="m-1 mr-2 px-1 flex items-center font-medium text-blue-800 bg-blue-100 rounded"
                            >
                                <div
                                    class="px-2 py-1 text-xs font-normal leading-none"
                                    x-text="option.text"
                                ></div>
                                <div
                                    class="inline-block"
                                    x-on:click.stop="remove(option, $dispatch)"
                                >
                                    <svg
                                        aria-hidden="true"
                                        focusable="false"
                                        class="w-3 h-3 fill-current"
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
                        </template>
                        <input
                            class="max-w-full flex-shrink italic font-light text-gray-400 min-w-12"
                            placeholder="{{ $placeholder }}"
                            x-on:keyup.arrow-up="highlightPrevious()"
                            x-on:keyup.arrow-down="highlightNext()"
                            x-on:keyup.backspace="removeLast()"
                            x-on:keyup.enter="addHighlighted()"
                            x-on:keyup="filter()"
                            x-ref="input"
                        >
                    </div>
                </div>
                <div class="mt-1 px-4 w-full">
                    <div
                        x-show.transition.origin.top="isOpen()"
                        class="min-w-full absolute left-0 z-40 overflow-hidden bg-white rounded shadow-md max-h-select"
                        x-on:click.away="close"
                    >
                        <div
                            x-ref="options"
                            class="w-full flex flex-col"
                        >
                            <template
                                x-for="option in unselectedOptions"
                                :key="option.index"
                            >
                                <div
                                    class="w-full border-b border-gray-100 cursor-pointer hover:bg-gray-100"
                                    x-on:click="select(option, $dispatch)"
                                >
                                    <div
                                        class="p-2 pl-2 w-full relative flex items-center border-l-2 border-transparent"
                                    >
                                        <div
                                            class="w-full flex items-center justify-between"
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

        <script>
            function dropdown{{ $uniqueId }}() {
                return {
                    field: document.querySelector("[name='{{ $name }}']") || {},
                    filterValue: "",
                    highlighted: 0,
                    livewireModel: "{{ $attributes->get("wire:model") }}",
                    selectedOptions: [],
                    show: false,
                    unselectedOptions: [],

                    initialize: function () {
                        console.log(this.field);
                        // this.setOptions();
                        this.selectedOptions = this.getSelectedOptions();
                        this.unselectedOptions = this.getUnselectedOptions();
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
                        // this.setOptions();
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

                        // this.setOptions();
                    },

                    select: function (option, dispatcher) {
                        this.field.options[option.index].setAttribute("selected", true);
                        // this.field.dispatchEvent(new Event('input'));
                        // dispatcher(this.value);

                        // this.setOptions();
                        this.$refs.input.focus();
                        this.highlighted = 0;
                    },

                    remove: function (option) {
                        this.field.options[option.index].removeAttribute('selected');
                        this.field.options[option.index].selected = false;

                        // this.setOptions();
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
                        return Array
                            .from(this.field.selectedOptions)
                            .filter(function (option) {
                                return option.text.toLowerCase() !== "{{ strtolower($placeholder) }}";
                            });
                    },
                };
            }
        </script>
    @endif

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
