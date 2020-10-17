let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.setPublicPath('public')
    .copy('node_modules/flatpickr/dist/flatpickr.min.js', 'public/datetimepicker.js')
    .copy('node_modules/flatpickr/dist/flatpickr.min.css', 'public/datetimepicker.css')
    .copy('node_modules/moment/min/moment.min.js', 'public/moment.js')
    .copy('node_modules/tether/dist/js/tether.min.js', 'public/tether.js')
    .copy('node_modules/signature_pad/dist/signature_pad.min.js', 'public/signature-pad.js')
    .sass('resources/assets/scss/app.scss', 'public/laravel-forms.css')
    .sass('resources/assets/scss/signature-pad.scss', 'public')
    .js('resources/assets/js/app.js', 'public/laravel-forms.js')
    .options({
        processCssUrls: false,
        postCss: [
            tailwindcss('tailwind.config.js')
        ],
    })
    .version()
;

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.stylus(src, output);
// mix.browserSync('my-site.dev');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
