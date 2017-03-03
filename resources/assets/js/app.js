
if (!window.$ && !global.$) {
    global.$ = global.jQuery = require('jquery');
}

// figure out how to conditionally include the framework
if (typeof $().modal !== 'function') {
    require('bootstrap-sass');
}

if (typeof $().bootstrapSwitch !== 'function') {
    require('bootstrap-switch');
}
