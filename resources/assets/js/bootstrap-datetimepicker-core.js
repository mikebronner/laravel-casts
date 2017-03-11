var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var DateTimePicker = function ($) {
    var NAME = 'datetimepicker',
        VERSION = '5.0.0-alpha.1',
        DATA_KEY = '' + NAME,
        EVENT_KEY = '.' + DATA_KEY,
        EMIT_EVENT_KEY = DATA_KEY + '.',
        DATA_API_KEY = '.data-api',
        Selector = {
        DATA_TOGGLE: '[data-toggle="' + DATA_KEY + '"]'
    },
        ClassName = {
        INPUT: NAME + '-input'
    },
        Event = {
        CHANGE: 'change' + EVENT_KEY,
        BLUR: 'blur' + EVENT_KEY,
        KEYUP: 'keyup' + EVENT_KEY,
        KEYDOWN: 'keydown' + EVENT_KEY,
        FOCUS: 'focus' + EVENT_KEY,
        CLICK_DATA_API: 'click' + EVENT_KEY + DATA_API_KEY,
        //emitted
        UPDATE: EMIT_EVENT_KEY + 'update',
        ERROR: EMIT_EVENT_KEY + 'error',
        HIDE: EMIT_EVENT_KEY + 'hide',
        SHOW: EMIT_EVENT_KEY + 'show'
    },
        Default = {
        timeZone: '',
        format: false,
        dayViewHeaderFormat: 'MMMM YYYY',
        extraFormats: false,
        stepping: 1,
        minDate: false,
        maxDate: false,
        useCurrent: true,
        collapse: true,
        locale: moment.locale(),
        defaultDate: false,
        disabledDates: false,
        enabledDates: false,
        icons: {
            time: 'glyphicon glyphicon-time',
            date: 'glyphicon glyphicon-calendar',
            up: 'glyphicon glyphicon-chevron-up',
            down: 'glyphicon glyphicon-chevron-down',
            previous: 'glyphicon glyphicon-chevron-left',
            next: 'glyphicon glyphicon-chevron-right',
            today: 'glyphicon glyphicon-screenshot',
            clear: 'glyphicon glyphicon-trash',
            close: 'glyphicon glyphicon-remove'
        },
        tooltips: {
            today: 'Go to today',
            clear: 'Clear selection',
            close: 'Close the picker',
            selectMonth: 'Select Month',
            prevMonth: 'Previous Month',
            nextMonth: 'Next Month',
            selectYear: 'Select Year',
            prevYear: 'Previous Year',
            nextYear: 'Next Year',
            selectDecade: 'Select Decade',
            prevDecade: 'Previous Decade',
            nextDecade: 'Next Decade',
            prevCentury: 'Previous Century',
            nextCentury: 'Next Century',
            pickHour: 'Pick Hour',
            incrementHour: 'Increment Hour',
            decrementHour: 'Decrement Hour',
            pickMinute: 'Pick Minute',
            incrementMinute: 'Increment Minute',
            decrementMinute: 'Decrement Minute',
            pickSecond: 'Pick Second',
            incrementSecond: 'Increment Second',
            decrementSecond: 'Decrement Second',
            togglePeriod: 'Toggle Period',
            selectTime: 'Select Time',
            selectDate: 'Select Date'
        },
        useStrict: false,
        sideBySide: false,
        daysOfWeekDisabled: false,
        calendarWeeks: false,
        viewMode: 'days',
        toolbarPlacement: 'default',
        buttons: {
            showToday: false,
            showClear: false,
            showClose: false
        },
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'auto'
        },
        widgetParent: null,
        ignoreReadonly: false,
        keepOpen: false,
        focusOnShow: true,
        inline: false,
        keepInvalid: false,
        keyBinds: {
            up: function up() {
                if (!this.widget) {
                    return false;
                }
                var d = this._date || this.getMoment();
                if (this.widget.find('.datepicker').is(':visible')) {
                    this.date(d.clone().subtract(7, 'd'));
                } else {
                    this.date(d.clone().add(this.stepping(), 'm'));
                }
                return true;
            },
            down: function down() {
                if (!this.widget) {
                    this.show();
                    return false;
                }
                var d = this._date || this.getMoment();
                if (this.widget.find('.datepicker').is(':visible')) {
                    this.date(d.clone().add(7, 'd'));
                } else {
                    this.date(d.clone().subtract(this.stepping(), 'm'));
                }
                return true;
            },
            'control up': function controlUp() {
                if (!this.widget) {
                    return false;
                }
                var d = this._date || this.getMoment();
                if (this.widget.find('.datepicker').is(':visible')) {
                    this.date(d.clone().subtract(1, 'y'));
                } else {
                    this.date(d.clone().add(1, 'h'));
                }
                return true;
            },
            'control down': function controlDown() {
                if (!this.widget) {
                    return false;
                }
                var d = this._date || this.getMoment();
                if (this.widget.find('.datepicker').is(':visible')) {
                    this.date(d.clone().add(1, 'y'));
                } else {
                    this.date(d.clone().subtract(1, 'h'));
                }
                return true;
            },
            left: function left() {
                if (!this.widget) {
                    return false;
                }
                var d = this._date || this.getMoment();
                if (this.widget.find('.datepicker').is(':visible')) {
                    this.date(d.clone().subtract(1, 'd'));
                }
                return true;
            },
            right: function right() {
                if (!this.widget) {
                    return false;
                }
                var d = this._date || this.getMoment();
                if (this.widget.find('.datepicker').is(':visible')) {
                    this.date(d.clone().add(1, 'd'));
                }
                return true;
            },
            pageUp: function pageUp() {
                if (!this.widget) {
                    return false;
                }
                var d = this._date || this.getMoment();
                if (this.widget.find('.datepicker').is(':visible')) {
                    this.date(d.clone().subtract(1, 'M'));
                }
                return true;
            },
            pageDown: function pageDown() {
                if (!this.widget) {
                    return false;
                }
                var d = this._date || this.getMoment();
                if (this.widget.find('.datepicker').is(':visible')) {
                    this.date(d.clone().add(1, 'M'));
                }
                return true;
            },
            enter: function enter() {
                this.hide();
                return true;
            },
            escape: function escape() {
                if (!this.widget) {
                    return false;
                }
                this.hide();
                return true;
            },
            'control space': function controlSpace() {
                if (!this.widget) {
                    return false;
                }
                if (this.widget.find('.timepicker').is(':visible')) {
                    this.widget.find('.btn[data-action="togglePeriod"]').click();
                }
                return true;
            },
            t: function t() {
                this.date(this.getMoment());
                return true;
            },
            'delete': function _delete() {
                if (!this.widget) {
                    return false;
                }
                this.clear();
                return true;
            }
        },
        debug: false,
        allowInputToggle: false,
        disabledTimeIntervals: false,
        disabledHours: false,
        enabledHours: false,
        viewDate: false
    },
        DatePickerModes = [{
        CLASS_NAME: 'days',
        NAV_FUNCTION: 'M',
        NAV_STEP: 1
    }, {
        CLASS_NAME: 'months',
        NAV_FUNCTION: 'y',
        NAV_STEP: 1
    }, {
        CLASS_NAME: 'years',
        NAV_FUNCTION: 'y',
        NAV_STEP: 10
    }, {
        CLASS_NAME: 'decades',
        NAV_FUNCTION: 'y',
        NAV_STEP: 100
    }],
        KeyMap = {
        'up': 38,
        38: 'up',
        'down': 40,
        40: 'down',
        'left': 37,
        37: 'left',
        'right': 39,
        39: 'right',
        'tab': 9,
        9: 'tab',
        'escape': 27,
        27: 'escape',
        'enter': 13,
        13: 'enter',
        'pageUp': 33,
        33: 'pageUp',
        'pageDown': 34,
        34: 'pageDown',
        'shift': 16,
        16: 'shift',
        'control': 17,
        17: 'control',
        'space': 32,
        32: 'space',
        't': 84,
        84: 't',
        'delete': 46,
        46: 'delete'
    },
        ViewModes = ['time', 'days', 'months', 'years', 'decades'];

    var MinViewModeNumber = 0,
        keyState = {},
        keyPressHandled = {};

    var DateTimePicker = function () {
        /** @namespace eData.dateOptions */
        /** @namespace moment.tz */

        function DateTimePicker(element, options) {
            _classCallCheck(this, DateTimePicker);

            this._options = this._getOptions(options);
            this._element = element;
            this._date = null;
            this._viewDate = null;
            this.unset = true;
            this.component = false;
            this.widget = false;
            this.use24Hours = null;
            this.actualFormat = null;
            this.parseFormats = null;
            this.currentViewMode = null;

            this._int();
        }

        /**
         * @return {string}
         */


        //private

        DateTimePicker.prototype._int = function _int() {
            var targetInput = this._element.data('target-input');
            if (this._element.is('input')) {
                this.input = this._element;
            } else if (targetInput !== undefined) {
                if (targetInput === 'nearest') {
                    this.input = this._element.find('input');
                } else {
                    this.input = $(targetInput);
                }
            }

            this._date = this.getMoment();
            this._viewDate = this._date.clone();

            $.extend(true, this._options, this._dataToOptions());

            this.options(this._options);

            this._initFormatting();

            if (this.input !== undefined && this.input.is('input') && this.input.val().trim().length !== 0) {
                this._setValue(this._parseInputDate(this.input.val().trim()));
            } else if (this._options.defaultDate && this.input !== undefined && this.input.attr('placeholder') === undefined) {
                this._setValue(this._options.defaultDate);
            }
            if (this._options.inline) {
                this.show();
            }
        };

        DateTimePicker.prototype._update = function _update() {
            if (!this.widget) {
                return;
            }
            this._fillDate();
            this._fillTime();
        };

        DateTimePicker.prototype._setValue = function _setValue(targetMoment) {
            var oldDate = this.unset ? null : this._date;

            // case of calling setValue(null or false)
            if (!targetMoment) {
                this.unset = true;
                if (this.input !== undefined) {
                    this.input.val('');
                    this.input.trigger('input');
                }
                this._element.data('date', '');
                this._notifyEvent({
                    type: DateTimePicker.Event.CHANGE,
                    date: false,
                    oldDate: oldDate
                });
                this._update();
                return;
            }

            targetMoment = targetMoment.clone().locale(this._options.locale);

            if (this._hasTimeZone()) {
                targetMoment.tz(this._options.timeZone);
            }

            if (this._options.stepping !== 1) {
                targetMoment.minutes(Math.round(targetMoment.minutes() / this._options.stepping) * this._options.stepping).seconds(0);
            }

            if (this._isValid(targetMoment)) {
                this._date = targetMoment;
                this._viewDate = targetMoment.clone();
                if (this.input !== undefined) {
                    this.input.val(this._date.format(this.actualFormat));
                    this.input.trigger('input');
                }
                this._element.data('date', this._date.format(this.actualFormat));
                this.unset = false;
                this._update();
                this._notifyEvent({
                    type: DateTimePicker.Event.CHANGE,
                    date: this._date.clone(),
                    oldDate: oldDate
                });
            } else {
                if (!this._options.keepInvalid) {
                    if (this.input !== undefined) {
                        this.input.val('' + (this.unset ? '' : this._date.format(this.actualFormat)));
                        this.input.trigger('input');
                    }
                } else {
                    this._notifyEvent({
                        type: DateTimePicker.Event.CHANGE,
                        date: targetMoment,
                        oldDate: oldDate
                    });
                }
                this._notifyEvent({
                    type: DateTimePicker.Event.ERROR,
                    date: targetMoment,
                    oldDate: oldDate
                });
            }
        };

        DateTimePicker.prototype._change = function _change(e) {
            var val = $(e.target).val().trim(),
                parsedDate = val ? this._parseInputDate(val) : null;
            this._setValue(parsedDate);
            e.stopImmediatePropagation();
            return false;
        };

        //noinspection JSMethodCanBeStatic


        DateTimePicker.prototype._getOptions = function _getOptions(options) {
            options = $.extend(true, {}, Default, options);
            return options;
        };

        DateTimePicker.prototype._hasTimeZone = function _hasTimeZone() {
            return moment.tz !== undefined && this._options.timeZone !== undefined && this._options.timeZone !== null && this._options.timeZone !== '';
        };

        DateTimePicker.prototype._isEnabled = function _isEnabled(granularity) {
            if (typeof granularity !== 'string' || granularity.length > 1) {
                throw new TypeError('isEnabled expects a single character string parameter');
            }
            switch (granularity) {
                case 'y':
                    return this.actualFormat.indexOf('Y') !== -1;
                case 'M':
                    return this.actualFormat.indexOf('M') !== -1;
                case 'd':
                    return this.actualFormat.toLowerCase().indexOf('d') !== -1;
                case 'h':
                case 'H':
                    return this.actualFormat.toLowerCase().indexOf('h') !== -1;
                case 'm':
                    return this.actualFormat.indexOf('m') !== -1;
                case 's':
                    return this.actualFormat.indexOf('s') !== -1;
                default:
                    return false;
            }
        };

        DateTimePicker.prototype._hasTime = function _hasTime() {
            return this._isEnabled('h') || this._isEnabled('m') || this._isEnabled('s');
        };

        DateTimePicker.prototype._hasDate = function _hasDate() {
            return this._isEnabled('y') || this._isEnabled('M') || this._isEnabled('d');
        };

        DateTimePicker.prototype._dataToOptions = function _dataToOptions() {
            var eData = this._element.data(),
                dataOptions = {};

            if (eData.dateOptions && eData.dateOptions instanceof Object) {
                dataOptions = $.extend(true, dataOptions, eData.dateOptions);
            }

            $.each(this._options, function (key) {
                var attributeName = 'date' + key.charAt(0).toUpperCase() + key.slice(1); //todo data api key
                if (eData[attributeName] !== undefined) {
                    dataOptions[key] = eData[attributeName];
                } else {
                    delete dataOptions[key];
                }
            });
            return dataOptions;
        };

        DateTimePicker.prototype._notifyEvent = function _notifyEvent(e) {
            if (e.type === DateTimePicker.Event.CHANGE && e.date && e.date.isSame(e.oldDate) || !e.date && !e.oldDate) {
                return;
            }
            this._element.trigger(e);
        };

        DateTimePicker.prototype._viewUpdate = function _viewUpdate(e) {
            if (e === 'y') {
                e = 'YYYY';
            }
            this._notifyEvent({
                type: DateTimePicker.Event.UPDATE,
                change: e,
                viewDate: this._viewDate.clone()
            });
        };

        DateTimePicker.prototype._showMode = function _showMode(dir) {
            if (!this.widget) {
                return;
            }
            if (dir) {
                this.currentViewMode = Math.max(MinViewModeNumber, Math.min(3, this.currentViewMode + dir));
            }
            this.widget.find('.datepicker > div').hide().filter('.datepicker-' + DatePickerModes[this.currentViewMode].CLASS_NAME).show();
        };

        DateTimePicker.prototype._isInDisabledDates = function _isInDisabledDates(testDate) {
            return this._options.disabledDates[testDate.format('YYYY-MM-DD')] === true;
        };

        DateTimePicker.prototype._isInEnabledDates = function _isInEnabledDates(testDate) {
            return this._options.enabledDates[testDate.format('YYYY-MM-DD')] === true;
        };

        DateTimePicker.prototype._isInDisabledHours = function _isInDisabledHours(testDate) {
            return this._options.disabledHours[testDate.format('H')] === true;
        };

        DateTimePicker.prototype._isInEnabledHours = function _isInEnabledHours(testDate) {
            return this._options.enabledHours[testDate.format('H')] === true;
        };

        DateTimePicker.prototype._isValid = function _isValid(targetMoment, granularity) {
            if (!targetMoment.isValid()) {
                return false;
            }
            if (this._options.disabledDates && granularity === 'd' && this._isInDisabledDates(targetMoment)) {
                return false;
            }
            if (this._options.enabledDates && granularity === 'd' && !this._isInEnabledDates(targetMoment)) {
                return false;
            }
            if (this._options.minDate && targetMoment.isBefore(this._options.minDate, granularity)) {
                return false;
            }
            if (this._options.maxDate && targetMoment.isAfter(this._options.maxDate, granularity)) {
                return false;
            }
            if (this._options.daysOfWeekDisabled && granularity === 'd' && this._options.daysOfWeekDisabled.indexOf(targetMoment.day()) !== -1) {
                return false;
            }
            if (this._options.disabledHours && (granularity === 'h' || granularity === 'm' || granularity === 's') && this._isInDisabledHours(targetMoment)) {
                return false;
            }
            if (this._options.enabledHours && (granularity === 'h' || granularity === 'm' || granularity === 's') && !this._isInEnabledHours(targetMoment)) {
                return false;
            }
            if (this._options.disabledTimeIntervals && (granularity === 'h' || granularity === 'm' || granularity === 's')) {
                var found = false;
                $.each(this._options.disabledTimeIntervals, function () {
                    if (targetMoment.isBetween(this[0], this[1])) {
                        found = true;
                        return false;
                    }
                });
                if (found) {
                    return false;
                }
            }
            return true;
        };

        DateTimePicker.prototype._parseInputDate = function _parseInputDate(inputDate) {
            if (this._options.parseInputDate === undefined) {
                if (!moment.isMoment(inputDate)) {
                    inputDate = this.getMoment(inputDate);
                }
            } else {
                inputDate = this._options.parseInputDate(inputDate);
            }
            //inputDate.locale(this.options.locale);
            return inputDate;
        };

        DateTimePicker.prototype._keydown = function _keydown(e) {
            var handler = null,
                index = void 0,
                index2 = void 0,
                keyBindKeys = void 0,
                allModifiersPressed = void 0;
            var pressedKeys = [],
                pressedModifiers = {},
                currentKey = e.which,
                pressed = 'p';

            keyState[currentKey] = pressed;

            for (index in keyState) {
                if (keyState.hasOwnProperty(index) && keyState[index] === pressed) {
                    pressedKeys.push(index);
                    if (parseInt(index, 10) !== currentKey) {
                        pressedModifiers[index] = true;
                    }
                }
            }

            for (index in this._options.keyBinds) {
                if (this._options.keyBinds.hasOwnProperty(index) && typeof this._options.keyBinds[index] === 'function') {
                    keyBindKeys = index.split(' ');
                    if (keyBindKeys.length === pressedKeys.length && KeyMap[currentKey] === keyBindKeys[keyBindKeys.length - 1]) {
                        allModifiersPressed = true;
                        for (index2 = keyBindKeys.length - 2; index2 >= 0; index2--) {
                            if (!(KeyMap[keyBindKeys[index2]] in pressedModifiers)) {
                                allModifiersPressed = false;
                                break;
                            }
                        }
                        if (allModifiersPressed) {
                            handler = this._options.keyBinds[index];
                            break;
                        }
                    }
                }
            }

            if (handler) {
                if (handler.call(this.widget)) {
                    e.stopPropagation();
                    e.preventDefault();
                }
            }
        };

        //noinspection JSMethodCanBeStatic,SpellCheckingInspection


        DateTimePicker.prototype._keyup = function _keyup(e) {
            keyState[e.which] = 'r';
            if (keyPressHandled[e.which]) {
                keyPressHandled[e.which] = false;
                e.stopPropagation();
                e.preventDefault();
            }
        };

        DateTimePicker.prototype._indexGivenDates = function _indexGivenDates(givenDatesArray) {
            // Store given enabledDates and disabledDates as keys.
            // This way we can check their existence in O(1) time instead of looping through whole array.
            // (for example: options.enabledDates['2014-02-27'] === true)
            var givenDatesIndexed = {},
                self = this;
            $.each(givenDatesArray, function () {
                var dDate = self._parseInputDate(this);
                if (dDate.isValid()) {
                    givenDatesIndexed[dDate.format('YYYY-MM-DD')] = true;
                }
            });
            return Object.keys(givenDatesIndexed).length ? givenDatesIndexed : false;
        };

        DateTimePicker.prototype._indexGivenHours = function _indexGivenHours(givenHoursArray) {
            // Store given enabledHours and disabledHours as keys.
            // This way we can check their existence in O(1) time instead of looping through whole array.
            // (for example: options.enabledHours['2014-02-27'] === true)
            var givenHoursIndexed = {};
            $.each(givenHoursArray, function () {
                givenHoursIndexed[this] = true;
            });
            return Object.keys(givenHoursIndexed).length ? givenHoursIndexed : false;
        };

        DateTimePicker.prototype._initFormatting = function _initFormatting() {
            var format = this._options.format || 'L LT';

            var self = this;
            this.actualFormat = format.replace(/(\[[^\[]*])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g, function (formatInput) {
                return self._date.localeData().longDateFormat(formatInput) || formatInput;
            });

            this.parseFormats = this._options.extraFormats ? this._options.extraFormats.slice() : [];
            if (this.parseFormats.indexOf(format) < 0 && this.parseFormats.indexOf(this.actualFormat) < 0) {
                this.parseFormats.push(this.actualFormat);
            }

            this.use24Hours = this.actualFormat.toLowerCase().indexOf('a') < 1 && this.actualFormat.replace(/\[.*?]/g, '').indexOf('h') < 1;

            if (this._isEnabled('y')) {
                MinViewModeNumber = 2;
            }
            if (this._isEnabled('M')) {
                MinViewModeNumber = 1;
            }
            if (this._isEnabled('d')) {
                MinViewModeNumber = 0;
            }

            this.currentViewMode = Math.max(MinViewModeNumber, this.currentViewMode);

            if (!this.unset) {
                this._setValue(this._date);
            }
        };

        //public


        DateTimePicker.prototype.getMoment = function getMoment(d) {
            var returnMoment = void 0;

            if (d === undefined || d === null) {
                returnMoment = moment(); //TODO should this use format? and locale?
            } else if (this._hasTimeZone()) {
                // There is a string to parse and a default time zone
                // parse with the tz function which takes a default time zone if it is not in the format string
                returnMoment = moment.tz(d, this.parseFormats, this._options.useStrict, this._options.timeZone);
            } else {
                returnMoment = moment(d, this.parseFormats, this._options.useStrict);
            }

            if (this._hasTimeZone()) {
                returnMoment.tz(this._options.timeZone);
            }

            return returnMoment;
        };

        DateTimePicker.prototype.toggle = function toggle() {
            return this.widget ? this.hide() : this.show();
        };

        DateTimePicker.prototype.ignoreReadonly = function ignoreReadonly(_ignoreReadonly) {
            if (arguments.length === 0) {
                return this._options.ignoreReadonly;
            }
            if (typeof _ignoreReadonly !== 'boolean') {
                throw new TypeError('ignoreReadonly () expects a boolean parameter');
            }
            this._options.ignoreReadonly = _ignoreReadonly;
        };

        DateTimePicker.prototype.options = function options(newOptions) {
            if (arguments.length === 0) {
                return $.extend(true, {}, this._options);
            }

            if (!(newOptions instanceof Object)) {
                throw new TypeError('options() this.options parameter should be an object');
            }
            $.extend(true, this._options, newOptions);
            var self = this;
            $.each(this._options, function (key, value) {
                if (self[key] !== undefined) {
                    self[key](value);
                }
            });
        };

        DateTimePicker.prototype.date = function date(newDate) {
            if (arguments.length === 0) {
                if (this.unset) {
                    return null;
                }
                return this._date.clone();
            }

            if (newDate !== null && typeof newDate !== 'string' && !moment.isMoment(newDate) && !(newDate instanceof Date)) {
                throw new TypeError('date() parameter must be one of [null, string, moment or Date]');
            }

            this._setValue(newDate === null ? null : this._parseInputDate(newDate));
        };

        DateTimePicker.prototype.format = function format(newFormat) {
            ///<summary>test su</summary>
            ///<param name="newFormat">info about para</param>
            ///<returns type="string|boolean">returns foo</returns>
            if (arguments.length === 0) {
                return this._options.format;
            }

            if (typeof newFormat !== 'string' && (typeof newFormat !== 'boolean' || newFormat !== false)) {
                throw new TypeError('format() expects a string or boolean:false parameter ' + newFormat);
            }

            this._options.format = newFormat;
            if (this.actualFormat) {
                this._initFormatting(); // reinitialize formatting
            }
        };

        DateTimePicker.prototype.timeZone = function timeZone(newZone) {
            if (arguments.length === 0) {
                return this._options.timeZone;
            }

            if (typeof newZone !== 'string') {
                throw new TypeError('newZone() expects a string parameter');
            }

            this._options.timeZone = newZone;
        };

        DateTimePicker.prototype.dayViewHeaderFormat = function dayViewHeaderFormat(newFormat) {
            if (arguments.length === 0) {
                return this._options.dayViewHeaderFormat;
            }

            if (typeof newFormat !== 'string') {
                throw new TypeError('dayViewHeaderFormat() expects a string parameter');
            }

            this._options.dayViewHeaderFormat = newFormat;
        };

        DateTimePicker.prototype.extraFormats = function extraFormats(formats) {
            if (arguments.length === 0) {
                return this._options.extraFormats;
            }

            if (formats !== false && !(formats instanceof Array)) {
                throw new TypeError('extraFormats() expects an array or false parameter');
            }

            this._options.extraFormats = formats;
            if (this.parseFormats) {
                this._initFormatting(); // reinit formatting
            }
        };

        DateTimePicker.prototype.disabledDates = function disabledDates(dates) {
            if (arguments.length === 0) {
                return this._options.disabledDates ? $.extend({}, this._options.disabledDates) : this._options.disabledDates;
            }

            if (!dates) {
                this._options.disabledDates = false;
                this._update();
                return;
            }
            if (!(dates instanceof Array)) {
                throw new TypeError('disabledDates() expects an array parameter');
            }
            this._options.disabledDates = this._indexGivenDates(dates);
            this._options.enabledDates = false;
            this._update();
        };

        DateTimePicker.prototype.enabledDates = function enabledDates(dates) {
            if (arguments.length === 0) {
                return this._options.enabledDates ? $.extend({}, this._options.enabledDates) : this._options.enabledDates;
            }

            if (!dates) {
                this._options.enabledDates = false;
                this._update();
                return;
            }
            if (!(dates instanceof Array)) {
                throw new TypeError('enabledDates() expects an array parameter');
            }
            this._options.enabledDates = this._indexGivenDates(dates);
            this._options.disabledDates = false;
            this._update();
        };

        DateTimePicker.prototype.daysOfWeekDisabled = function daysOfWeekDisabled(_daysOfWeekDisabled) {
            if (arguments.length === 0) {
                return this._options.daysOfWeekDisabled.splice(0);
            }

            if (typeof _daysOfWeekDisabled === 'boolean' && !_daysOfWeekDisabled) {
                this._options.daysOfWeekDisabled = false;
                this._update();
                return;
            }

            if (!(_daysOfWeekDisabled instanceof Array)) {
                throw new TypeError('daysOfWeekDisabled() expects an array parameter');
            }
            this._options.daysOfWeekDisabled = _daysOfWeekDisabled.reduce(function (previousValue, currentValue) {
                currentValue = parseInt(currentValue, 10);
                if (currentValue > 6 || currentValue < 0 || isNaN(currentValue)) {
                    return previousValue;
                }
                if (previousValue.indexOf(currentValue) === -1) {
                    previousValue.push(currentValue);
                }
                return previousValue;
            }, []).sort();
            if (this._options.useCurrent && !this._options.keepInvalid) {
                var tries = 0;
                while (!this._isValid(this._date, 'd')) {
                    this._date.add(1, 'd');
                    if (tries === 31) {
                        throw 'Tried 31 times to find a valid date';
                    }
                    tries++;
                }
                this._setValue(this._date);
            }
            this._update();
        };

        DateTimePicker.prototype.maxDate = function maxDate(_maxDate) {
            if (arguments.length === 0) {
                return this._options.maxDate ? this._options.maxDate.clone() : this._options.maxDate;
            }

            if (typeof _maxDate === 'boolean' && _maxDate === false) {
                this._options.maxDate = false;
                this._update();
                return;
            }

            if (typeof _maxDate === 'string') {
                if (_maxDate === 'now' || _maxDate === 'moment') {
                    _maxDate = this.getMoment();
                }
            }

            var parsedDate = this._parseInputDate(_maxDate);

            if (!parsedDate.isValid()) {
                throw new TypeError('maxDate() Could not parse date parameter: ' + _maxDate);
            }
            if (this._options.minDate && parsedDate.isBefore(this._options.minDate)) {
                throw new TypeError('maxDate() date parameter is before this.options.minDate: ' + parsedDate.format(this.actualFormat));
            }
            this._options.maxDate = parsedDate;
            if (this._options.useCurrent && !this._options.keepInvalid && this._date.isAfter(_maxDate)) {
                this._setValue(this._options.maxDate);
            }
            if (this._viewDate.isAfter(parsedDate)) {
                this._viewDate = parsedDate.clone().subtract(this._options.stepping, 'm');
            }
            this._update();
        };

        DateTimePicker.prototype.minDate = function minDate(_minDate) {
            if (arguments.length === 0) {
                return this._options.minDate ? this._options.minDate.clone() : this._options.minDate;
            }

            if (typeof _minDate === 'boolean' && _minDate === false) {
                this._options.minDate = false;
                this._update();
                return;
            }

            if (typeof _minDate === 'string') {
                if (_minDate === 'now' || _minDate === 'moment') {
                    _minDate = this.getMoment();
                }
            }

            var parsedDate = this._parseInputDate(_minDate);

            if (!parsedDate.isValid()) {
                throw new TypeError('minDate() Could not parse date parameter: ' + _minDate);
            }
            if (this._options.maxDate && parsedDate.isAfter(this._options.maxDate)) {
                throw new TypeError('minDate() date parameter is after this.options.maxDate: ' + parsedDate.format(this.actualFormat));
            }
            this._options.minDate = parsedDate;
            if (this._options.useCurrent && !this._options.keepInvalid && this._date.isBefore(_minDate)) {
                this._setValue(this._options.minDate);
            }
            if (this._viewDate.isBefore(parsedDate)) {
                this._viewDate = parsedDate.clone().add(this._options.stepping, 'm');
            }
            this._update();
        };

        DateTimePicker.prototype.defaultDate = function defaultDate(_defaultDate) {
            if (arguments.length === 0) {
                return this._options.defaultDate ? this._options.defaultDate.clone() : this._options.defaultDate;
            }
            if (!_defaultDate) {
                this._options.defaultDate = false;
                return;
            }

            if (typeof _defaultDate === 'string') {
                if (_defaultDate === 'now' || _defaultDate === 'moment') {
                    _defaultDate = this.getMoment();
                } else {
                    _defaultDate = this.getMoment(_defaultDate);
                }
            }

            var parsedDate = this._parseInputDate(_defaultDate);
            if (!parsedDate.isValid()) {
                throw new TypeError('defaultDate() Could not parse date parameter: ' + _defaultDate);
            }
            if (!this._isValid(parsedDate)) {
                throw new TypeError('defaultDate() date passed is invalid according to component setup validations');
            }

            this._options.defaultDate = parsedDate;

            if (this._options.defaultDate && this._options.inline || this.input !== undefined && this.input.val().trim() === '') {
                this._setValue(this._options.defaultDate);
            }
        };

        DateTimePicker.prototype.locale = function locale(_locale) {
            if (arguments.length === 0) {
                return this._options.locale;
            }

            if (!moment.localeData(_locale)) {
                throw new TypeError('locale() locale ' + _locale + ' is not loaded from moment locales!');
            }

            this._options.locale = _locale;
            this._date.locale(this._options.locale);
            this._viewDate.locale(this._options.locale);

            if (this.actualFormat) {
                this._initFormatting(); // reinitialize formatting
            }
            if (this.widget) {
                this.hide();
                this.show();
            }
        };

        DateTimePicker.prototype.stepping = function stepping(_stepping) {
            if (arguments.length === 0) {
                return this._options.stepping;
            }

            _stepping = parseInt(_stepping, 10);
            if (isNaN(_stepping) || _stepping < 1) {
                _stepping = 1;
            }
            this._options.stepping = _stepping;
        };

        DateTimePicker.prototype.useCurrent = function useCurrent(_useCurrent) {
            var useCurrentOptions = ['year', 'month', 'day', 'hour', 'minute'];
            if (arguments.length === 0) {
                return this._options.useCurrent;
            }

            if (typeof _useCurrent !== 'boolean' && typeof _useCurrent !== 'string') {
                throw new TypeError('useCurrent() expects a boolean or string parameter');
            }
            if (typeof _useCurrent === 'string' && useCurrentOptions.indexOf(_useCurrent.toLowerCase()) === -1) {
                throw new TypeError('useCurrent() expects a string parameter of ' + useCurrentOptions.join(', '));
            }
            this._options.useCurrent = _useCurrent;
        };

        DateTimePicker.prototype.collapse = function collapse(_collapse) {
            if (arguments.length === 0) {
                return this._options.collapse;
            }

            if (typeof _collapse !== 'boolean') {
                throw new TypeError('collapse() expects a boolean parameter');
            }
            if (this._options.collapse === _collapse) {
                return;
            }
            this._options.collapse = _collapse;
            if (this.widget) {
                this.hide();
                this.show();
            }
        };

        DateTimePicker.prototype.icons = function icons(_icons) {
            if (arguments.length === 0) {
                return $.extend({}, this._options.icons);
            }

            if (!(_icons instanceof Object)) {
                throw new TypeError('icons() expects parameter to be an Object');
            }

            $.extend(this._options.icons, _icons);

            if (this.widget) {
                this.hide();
                this.show();
            }
        };

        DateTimePicker.prototype.tooltips = function tooltips(_tooltips) {
            if (arguments.length === 0) {
                return $.extend({}, this._options.tooltips);
            }

            if (!(_tooltips instanceof Object)) {
                throw new TypeError('tooltips() expects parameter to be an Object');
            }
            $.extend(this._options.tooltips, _tooltips);
            if (this.widget) {
                this.hide();
                this.show();
            }
        };

        DateTimePicker.prototype.useStrict = function useStrict(_useStrict) {
            if (arguments.length === 0) {
                return this._options.useStrict;
            }

            if (typeof _useStrict !== 'boolean') {
                throw new TypeError('useStrict() expects a boolean parameter');
            }
            this._options.useStrict = _useStrict;
        };

        DateTimePicker.prototype.sideBySide = function sideBySide(_sideBySide) {
            if (arguments.length === 0) {
                return this._options.sideBySide;
            }

            if (typeof _sideBySide !== 'boolean') {
                throw new TypeError('sideBySide() expects a boolean parameter');
            }
            this._options.sideBySide = _sideBySide;
            if (this.widget) {
                this.hide();
                this.show();
            }
        };

        DateTimePicker.prototype.viewMode = function viewMode(_viewMode) {
            if (arguments.length === 0) {
                return this._options.viewMode;
            }

            if (typeof _viewMode !== 'string') {
                throw new TypeError('viewMode() expects a string parameter');
            }

            if (DateTimePicker.ViewModes.indexOf(_viewMode) === -1) {
                throw new TypeError('viewMode() parameter must be one of (' + DateTimePicker.ViewModes.join(', ') + ') value');
            }

            this._options.viewMode = _viewMode;
            this.currentViewMode = Math.max(DateTimePicker.ViewModes.indexOf(_viewMode) - 1, DateTimePicker.MinViewModeNumber);

            this._showMode();
        };

        DateTimePicker.prototype.calendarWeeks = function calendarWeeks(_calendarWeeks) {
            if (arguments.length === 0) {
                return this._options.calendarWeeks;
            }

            if (typeof _calendarWeeks !== 'boolean') {
                throw new TypeError('calendarWeeks() expects parameter to be a boolean value');
            }

            this._options.calendarWeeks = _calendarWeeks;
            this._update();
        };

        DateTimePicker.prototype.buttons = function buttons(_buttons) {
            if (arguments.length === 0) {
                return $.extend({}, this._options.buttons);
            }

            if (!(_buttons instanceof Object)) {
                throw new TypeError('buttons() expects parameter to be an Object');
            }

            $.extend(this._options.buttons, _buttons);

            if (typeof this._options.buttons.showToday !== 'boolean') {
                throw new TypeError('buttons.showToday expects a boolean parameter');
            }
            if (typeof this._options.buttons.showClear !== 'boolean') {
                throw new TypeError('buttons.showClear expects a boolean parameter');
            }
            if (typeof this._options.buttons.showClose !== 'boolean') {
                throw new TypeError('buttons.showClose expects a boolean parameter');
            }

            if (this.widget) {
                this.hide();
                this.show();
            }
        };

        DateTimePicker.prototype.keepOpen = function keepOpen(_keepOpen) {
            if (arguments.length === 0) {
                return this._options.keepOpen;
            }

            if (typeof _keepOpen !== 'boolean') {
                throw new TypeError('keepOpen() expects a boolean parameter');
            }

            this._options.keepOpen = _keepOpen;
        };

        DateTimePicker.prototype.focusOnShow = function focusOnShow(_focusOnShow) {
            if (arguments.length === 0) {
                return this._options.focusOnShow;
            }

            if (typeof _focusOnShow !== 'boolean') {
                throw new TypeError('focusOnShow() expects a boolean parameter');
            }

            this._options.focusOnShow = _focusOnShow;
        };

        DateTimePicker.prototype.inline = function inline(_inline) {
            if (arguments.length === 0) {
                return this._options.inline;
            }

            if (typeof _inline !== 'boolean') {
                throw new TypeError('inline() expects a boolean parameter');
            }

            this._options.inline = _inline;
        };

        DateTimePicker.prototype.clear = function clear() {
            this._setValue(null);
        };

        DateTimePicker.prototype.keyBinds = function keyBinds(_keyBinds) {
            if (arguments.length === 0) {
                return this._options.keyBinds;
            }

            this._options.keyBinds = _keyBinds;
        };

        DateTimePicker.prototype.debug = function debug(_debug) {
            if (typeof _debug !== 'boolean') {
                throw new TypeError('debug() expects a boolean parameter');
            }

            this._options.debug = _debug;
        };

        DateTimePicker.prototype.allowInputToggle = function allowInputToggle(_allowInputToggle) {
            if (arguments.length === 0) {
                return this._options.allowInputToggle;
            }

            if (typeof _allowInputToggle !== 'boolean') {
                throw new TypeError('allowInputToggle() expects a boolean parameter');
            }

            this._options.allowInputToggle = _allowInputToggle;
        };

        DateTimePicker.prototype.keepInvalid = function keepInvalid(_keepInvalid) {
            if (arguments.length === 0) {
                return this._options.keepInvalid;
            }

            if (typeof _keepInvalid !== 'boolean') {
                throw new TypeError('keepInvalid() expects a boolean parameter');
            }
            this._options.keepInvalid = _keepInvalid;
        };

        DateTimePicker.prototype.datepickerInput = function datepickerInput(_datepickerInput) {
            if (arguments.length === 0) {
                return this._options.datepickerInput;
            }

            if (typeof _datepickerInput !== 'string') {
                throw new TypeError('datepickerInput() expects a string parameter');
            }

            this._options.datepickerInput = _datepickerInput;
        };

        DateTimePicker.prototype.parseInputDate = function parseInputDate(_parseInputDate2) {
            if (arguments.length === 0) {
                return this._options.parseInputDate;
            }

            if (typeof _parseInputDate2 !== 'function') {
                throw new TypeError('parseInputDate() should be as function');
            }

            this._options.parseInputDate = _parseInputDate2;
        };

        DateTimePicker.prototype.disabledTimeIntervals = function disabledTimeIntervals(_disabledTimeIntervals) {
            if (arguments.length === 0) {
                return this._options.disabledTimeIntervals ? $.extend({}, this._options.disabledTimeIntervals) : this._options.disabledTimeIntervals;
            }

            if (!_disabledTimeIntervals) {
                this._options.disabledTimeIntervals = false;
                this._update();
                return;
            }
            if (!(_disabledTimeIntervals instanceof Array)) {
                throw new TypeError('disabledTimeIntervals() expects an array parameter');
            }
            this._options.disabledTimeIntervals = _disabledTimeIntervals;
            this._update();
        };

        DateTimePicker.prototype.disabledHours = function disabledHours(hours) {
            if (arguments.length === 0) {
                return this._options.disabledHours ? $.extend({}, this._options.disabledHours) : this._options.disabledHours;
            }

            if (!hours) {
                this._options.disabledHours = false;
                this._update();
                return;
            }
            if (!(hours instanceof Array)) {
                throw new TypeError('disabledHours() expects an array parameter');
            }
            this._options.disabledHours = this._indexGivenHours(hours);
            this._options.enabledHours = false;
            if (this._options.useCurrent && !this._options.keepInvalid) {
                var tries = 0;
                while (!this._isValid(this._date, 'h')) {
                    this._date.add(1, 'h');
                    if (tries === 24) {
                        throw 'Tried 24 times to find a valid date';
                    }
                    tries++;
                }
                this._setValue(this._date);
            }
            this._update();
        };

        DateTimePicker.prototype.enabledHours = function enabledHours(hours) {
            if (arguments.length === 0) {
                return this._options.enabledHours ? $.extend({}, this._options.enabledHours) : this._options.enabledHours;
            }

            if (!hours) {
                this._options.enabledHours = false;
                this._update();
                return;
            }
            if (!(hours instanceof Array)) {
                throw new TypeError('enabledHours() expects an array parameter');
            }
            this._options.enabledHours = this._indexGivenHours(hours);
            this._options.disabledHours = false;
            if (this._options.useCurrent && !this._options.keepInvalid) {
                var tries = 0;
                while (!this._isValid(this._date, 'h')) {
                    this._date.add(1, 'h');
                    if (tries === 24) {
                        throw 'Tried 24 times to find a valid date';
                    }
                    tries++;
                }
                this._setValue(this._date);
            }
            this._update();
        };

        DateTimePicker.prototype.viewDate = function viewDate(newDate) {
            if (arguments.length === 0) {
                return this._viewDate.clone();
            }

            if (!newDate) {
                this._viewDate = this._date.clone();
                return;
            }

            if (typeof newDate !== 'string' && !moment.isMoment(newDate) && !(newDate instanceof Date)) {
                throw new TypeError('viewDate() parameter must be one of [string, moment or Date]');
            }

            this._viewDate = this._parseInputDate(newDate);
            this._viewUpdate();
        };

        _createClass(DateTimePicker, null, [{
            key: 'NAME',
            get: function get() {
                return NAME;
            }

            /**
             * @return {string}
             */

        }, {
            key: 'VERSION',
            get: function get() {
                return VERSION;
            }

            /**
             * @return {string}
             */

        }, {
            key: 'DATA_KEY',
            get: function get() {
                return DATA_KEY;
            }

            /**
             * @return {string}
             */

        }, {
            key: 'EVENT_KEY',
            get: function get() {
                return EVENT_KEY;
            }

            /**
             * @return {string}
             */

        }, {
            key: 'DATA_API_KEY',
            get: function get() {
                return DATA_API_KEY;
            }
        }, {
            key: 'DatePickerModes',
            get: function get() {
                return DatePickerModes;
            }
        }, {
            key: 'ViewModes',
            get: function get() {
                return ViewModes;
            }

            /**
             * @return {number}
             */

        }, {
            key: 'MinViewModeNumber',
            get: function get() {
                return MinViewModeNumber;
            }
        }, {
            key: 'Event',
            get: function get() {
                return Event;
            }
        }, {
            key: 'Selector',
            get: function get() {
                return Selector;
            }
        }, {
            key: 'Default',
            get: function get() {
                return Default;
            }
        }, {
            key: 'ClassName',
            get: function get() {
                return ClassName;
            }
        }]);

        return DateTimePicker;
    }();

    return DateTimePicker;
}(jQuery);
