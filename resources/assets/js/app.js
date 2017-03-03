
if (!window.$ && !global.$) {
    global.$ = global.jQuery = require('jquery');
}

// figure out how to conditionally include the framework
if (typeof $().modal !== 'function') {
    require('bootstrap-sass');

    var head  = document.getElementsByTagName('head')[0];
    var link  = document.createElement('link');

    link.rel  = 'stylesheet';
    link.type = 'text/css';
    link.href = '/genealabs-laravel-casts/app.css';
    link.media = 'all';
    head.insertBefore(link, head.firstChild);
}

if (typeof $().bootstrapSwitch !== 'function') {
    require('bootstrap-switch');
}
