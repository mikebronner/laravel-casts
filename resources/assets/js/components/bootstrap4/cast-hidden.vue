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
        },
    };
</script>

<template>
    <input type="hidden" :name="name" :value="value">
</template>
