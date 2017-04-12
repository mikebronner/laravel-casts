let mix = require('laravel-mix');

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
    .copy('node_modules/tempusdominus-bootstrap-3/build/js/tempusdominus-bootstrap-3.min.js', 'public/bootstrap3-datetimepicker.js')
    .copy('node_modules/tempusdominus-bootstrap-3/build/css/tempusdominus-bootstrap-3.min.css', 'public/bootstrap3-datetimepicker.css')
    .copy('node_modules/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js', 'public/bootstrap4-datetimepicker.js')
    .copy('node_modules/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css', 'public/bootstrap4-datetimepicker.css')
    .copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js', 'public/bootstrap3.js')
    .copy('node_modules/font-awesome/fonts', 'public/fonts')
    .copy('node_modules/moment/min/moment.min.js', 'public/moment.js')
    .copy('node_modules/tether/dist/js/tether.min.js', 'public/tether.js')
    .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/bootstrap4.js')
    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/bootstrap4.css')
    .sass('resources/assets/scss/bootstrap4-custom.scss', '')
    .copy('node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css', 'public/bootstrap-switch.css')
    .copy('node_modules/bootstrap-switch/dist/js/bootstrap-switch.min.js', 'public/bootstrap-switch.js')
    .copy('node_modules/signature_pad/dist/signature_pad.min.js', 'public/signature-pad.js')
    .copy('node_modules/selectize/dist/css/selectize.bootstrap3.css', 'public/bootstrap3-combobox.css')
    .copy('node_modules/selectize/dist/js/standalone/selectize.min.js', 'public/bootstrap-combobox.js')
    .sass('resources/assets/scss/font-awesome.scss', 'public')
    .sass('resources/assets/scss/bootstrap3.scss', 'public')
    .sass('resources/assets/scss/signature-pad.scss', 'public')
    .copy('resources/assets/js/app.js', 'public/app.js')
    // .js('resources/assets/js/bootstrap3-datetimepicker.js', '')
    // .version()
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
