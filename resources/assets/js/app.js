
if (typeof $().html !== 'function') {
    global.$ = global.jQuery = require('jquery');
}

if (typeof $().modal !== 'function') {
    require('bootstrap-sass');
}

if (typeof $().bootstrapSwitch !== 'function') {
    require('bootstrap-switch');
}
