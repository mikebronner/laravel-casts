<script>
    module.exports = {
        name: "cast-hidden",

        props: {
            name: {
                type: String,
                required: true
            },

            value: {
                type: String,
                required: false,
                default: '',
            },

            options: {
                type: Object,
                required: false,
                default: function () { return {}; },
            },
        },

        data: function () {
            return {
                errors: (this.$parent.errors || {}),
                fieldWidth: _.get(this.options, 'fieldWidth', (this.$parent.fieldWidth || 9)),
                isHorizontal: (this.$parent.isHorizontal || false),
                labelWidth: _.get(this.options, 'labelWidth', 12 - this.fieldWidth),
            };
        },

        computed: {
            attributes: function () {
                var values = _.values(this.options);
                var keys = _.keys(this.options);
                var attributes = [];

                for (var index = 0; index < values.length; index++) {
                    attributes.push(keys[index] + '="' + values[index] + '"');
                }

                return _.join(attributes, ' ');
            },

            controlHtml: function () {
                return '<input type="checkbox" name="' + this.name + '" value="' + this.value + '" ' + this.checked + ' ' + this.attributes + '>' + this.label;
            },

            errorMessage: function () {
                return _.chain(this.errrors)
                    .get(this.name, '')
                    .join(' ');
            },

            hasErrors: function () {
                return (this.errors.length > 1);
            },

            horizontalFormClasses: function () {
                return this.$parent.isHorizontal
                    ? 'ml-auto col-sm-' + this.$parent.fieldWidth
                    : '';
            },

            label: function () {
                return _.get(this.options, 'label', '');
            }
        },
    };
</script>

<template>
    <div :class="horizontalFormClasses">
        <div class="form-check">
            <label class="form-check-label" v-html="controlHtml"></label>
        </div>

        <div class="invalid-feedback"
            v-if="hasErrors"
            :text="errorMessage"
        ></div>
    </div>
</template>
