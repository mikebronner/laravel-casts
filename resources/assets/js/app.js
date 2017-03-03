if (!window.$ && !global.$) {
    global.$ = global.jQuery = require('jquery');
}

if (typeof $().alert !== 'function') {
    if (window.genealabsLaravelCasts.framework === 'bootstrap3') {
        require('bootstrap-sass');
    }

    if (window.genealabsLaravelCasts.framework === 'bootstrap4') {
        global.Tether = require('tether');
        require('bootstrap');
    }
}

if ($.fn.alert.Constructor.VERSION.charAt(0) === '3') {
    insertCssLink('/genealabs-laravel-casts/bootstrap3.css');
}

if ($.fn.alert.Constructor.VERSION.charAt(0) === '4') {
    insertCssLink('/genealabs-laravel-casts/bootstrap4.css');
}

if (typeof $().bootstrapSwitch !== 'function') {
    require('bootstrap-switch');
    insertCssLink('/genealabs-laravel-casts/bootstrap-switch.css');
}

function insertCssLink(path)
{
    var head  = document.getElementsByTagName('head')[0];
    var link  = document.createElement('link');

    link.rel  = 'stylesheet';
    link.type = 'text/css';
    link.href = path;
    link.media = 'all';
    head.insertBefore(link, head.firstChild);
}
