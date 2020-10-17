// tailwind.config.js
module.exports = {
    purge: [
        './resources/**/*.html',
        './resources/**/*.js',
        './resources/**/*.css',
        './resources/**/*.php',
        './src/**/*.php',
    ],
    theme: {},
    variants: ['responsive', 'group-hover', 'group-focus', 'focus-within', 'first', 'last', 'odd', 'even', 'hover', 'focus', 'active', 'visited', 'disabled'],
    plugins: [],
}
