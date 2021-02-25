<x-form-group
    :class="$groupClasses"
    :errors="$errors"
    x-data="app()"
    x-init="[initDate(), getNoOfDays()]"
    x-cloak
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <div class="relative">
        <input
            x-model="datepickerValue"
            x-on:click="showDatepicker = !showDatepicker"
            x-on:keydown.escape="showDatepicker = false"
            x-on:keyup="updateSelectedDate"
            {{ $attributes->merge(["class" => "form-input"]) }}
            type="date"
            name="{{ $name }}"
            value="{{ $value }}"
        >
        <div
            class="mt-12 p-4 absolute top-0 left-0 bg-white rounded-lg shadow"
            style="width: 17rem"
            x-show.transition="showDatepicker"
            x-on:click.away="showDatepicker = false"
        >
            <div class="mb-2 flex items-center justify-between">
                <div>
                    <span x-text="months[month]" class="text-lg font-bold text-gray-800"></span>
                    <span x-text="year" class="ml-1 text-lg font-normal text-gray-600"></span>
                </div>
                <div>
                    <button
                        type="button"
                        class="p-1 inline-flex transition duration-100 ease-in-out rounded-full cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-200"
                        x-on:click="subMonth"
                    >
                        <svg class="w-6 h-6 inline-flex text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="p-1 inline-flex transition duration-100 ease-in-out rounded-full cursor-pointer focus:outline-none focus:shadow-outline hover:bg-gray-200"
                        x-on:click="addMonth"
                    >
                        <svg class="w-6 h-6 inline-flex text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mb-3 -mx-1 flex flex-wrap">
                <template x-for="(day, index) in days" :key="index">
                    <div style="width: 14.26%" class="px-1">
                        <div x-text="day" class="text-xs font-medium text-center text-gray-800"></div>
                    </div>
                </template>
            </div>

            <div class="-mx-1 flex flex-wrap">
                <template x-for="blankday in blankdays">
                    <div style="width: 14.28%" class="p-1 text-sm text-center border border-transparent"></div>
                </template>
                <template
                    x-for="date in no_of_days"
                    :key="'date' + date"
                >
                    <div style="width: 14.28%" class="mb-1 px-1">
                        <div
                            x-on:click="getDateValue(date);"
                            x-text="date"
                            class="text-sm leading-none leading-loose text-center transition duration-100 ease-in-out rounded-full cursor-pointer"
                            x-bind:class="{
                                'bg-blue-500 text-white': isToday(date) == true,
                                'text-gray-700 hover:bg-blue-200': isToday(date) == false,
                            }"
                        ></div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</x-form-group>
<script>
    function app()
    {
        return {
            showDatepicker: false,
            datepickerValue: '',
            month: '',
            year: '',
            no_of_days: [],
            blankdays: [],
            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

            initDate: function () {
                let today = new Date();
                this.month = today.getMonth();
                this.year = today.getFullYear();
            },

            isToday: function (date) {
                const today = new Date();
                const d = new Date(this.year, this.month, date);

                return today.toDateString() === d.toDateString() ? true : false;
            },

            getDateValue: function (date) {
                let selectedDate = new Date(this.year, this.month + 1, date);

                this.datepickerValue = ('0' + (selectedDate.getMonth())).slice(-2) + "/" + ('0' + selectedDate.getDate()).slice(-2) + "/" + selectedDate.getFullYear();
                this.showDatepicker = false;
            },

            getNoOfDays: function () {
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                let dayOfWeek = new Date(this.year, this.month).getDay();
                let blankdaysArray = [];
                let daysArray = [];

                for (var i = 1; i <= dayOfWeek; i++) {
                    blankdaysArray.push(i);
                }

                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }

                this.blankdays = blankdaysArray;
                this.no_of_days = daysArray;
            },

            updateSelectedDate: function () {
                let dateParts = this.datepickerValue.split("/");

                if (
                    dateParts.length === 3
                    && dateParts[2].length >= 2
                ) {
                    this.year = parseInt(dateParts[2]);
                    this.month = parseInt(dateParts[0]) - 1;
                }
            },

            subMonth: function () {
                if (this.month == 0) {
                    this.year--;
                    this.month = 12;
                }

                this.month--;
                this.getNoOfDays();
            },

            addMonth: function () {
                if (this.month == 11) {
                    this.month = 0;
                    this.year++;
                } else {
                    this.month++;
                };

                this.getNoOfDays();
            }
        };
    }
</script>
