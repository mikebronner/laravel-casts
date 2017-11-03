<script>
    module.exports = {
        name: "cast-form",

        props: {
            action: {
                type: String,
                required: false,
                default: '',
            },

            method: {
                type: String,
                required: false,
                default: 'POST',
            },

            options: {
                type: Object,
                required: false,
                default: function () { return {}; },
            },
        },

        data: function () {
            return {

            };
        },

        computed: {
            csrfToken: function () {
                let csrfToken = ((document.head.querySelector('meta[name="csrf-token"]') || {}).content
                    || (this.options.csrf-token || ''));

                if (csrfToken == '') {
                    console.error('CSRF-Token not provided. Please add a \'csrf-token\' meta tag to the page, or pass it to the form in the options object.');
                }

                return csrfToken;
            },

            encType: function () {
                return ((this.options.files || false)
                    ? 'multipart/form-data'
                    : '');
            },

            formClass: function () {
                return (this.options.class || '');
            },
        },

        methods: {

        },
    };
</script>

<template>
    <form :action="action" :method="method" :enctype="encType" :class="formClass">
        <cast-hidden name="csrf_token" :value="csrfToken"></cast-hidden>
        <slot></slot>
    </form>
</template>

<style lang="scss" scoped>

</style>
