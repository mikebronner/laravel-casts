if (typeof _ === undefined) {
    global._ = require('lodash');
}

if (typeof jQuery === undefined) {
    global.jQuery = $;
}

if (typeof moment === undefined) {
    global.moment = require('moment');
}

window['genealabsLaravelCasts'] = window.genealabsLaravelCasts || {};
window.genealabsLaravelCasts['framework'] = window.genealabsLaravelCasts.framework || 'vanilla';

if ((window.genealabsLaravelCasts.framework === 'vanilla')
    && (typeof $.fn.alert.Constructor.VERSION !== undefined)
    && ($.fn.alert.Constructor.VERSION.charAt(0) === '4')
) {
    window.genealabsLaravelCasts.framework = "bootstrap3";
}

if ((window.genealabsLaravelCasts.framework === 'vanilla')
    && (typeof $.fn.alert.Constructor.VERSION !== undefined)
    && ($.fn.alert.Constructor.VERSION.charAt(0) === '4')
) {
    window.genealabsLaravelCasts.framework = "bootstrap4";
}

// if ((window.genealabsLaravelCasts.bootstrapSwitchLoaders || false) !== false) {
//     insertCssLink('/genealabs-laravel-casts/bootstrap-switch.css');
//     $.getScript('/genealabs-laravel-casts/bootstrap-switch.js', function () {
//         _.each(window.genealabsLaravelCasts.bootstrapSwitchLoaders, function (bootstrapSwitchLoader) {
//             bootstrapSwitchLoader();
//         });
//     });
// }
//
if ((window.genealabsLaravelCasts.dateTimeLoaders || false) !== false) {
    if (window.genealabsLaravelCasts.framework === "bootstrap3") {
        insertCssLink('/genealabs-laravel-casts/bootstrap3-datetimepicker.css');
        $.getScript('/genealabs-laravel-casts/bootstrap3-datetimepicker.js', function () {
            _.each(window.genealabsLaravelCasts.dateTimeLoaders, function (dateTimeLoader) {
                dateTimeLoader();
            });
        });
    } else if (window.genealabsLaravelCasts.framework === "bootstrap4") {
        insertCssLink('/genealabs-laravel-casts/bootstrap4-datetimepicker.css');
        jQuery.getScript('/genealabs-laravel-casts/bootstrap4-datetimepicker.js', function () {
            setTimeout(function () {
                loadDateTimePickerPlugin($);
                global.jQuery = global.$ = loadDateTimePickerPlugin($);
                console.log($.fn.datetimepicker);
                window.genealabsLaravelCasts.dateTimeLoaders.forEach(function (dateTimeLoader) {
                    dateTimeLoader();
                });
            }, 100);
        });
    }
}

if ((window.genealabsLaravelCasts.switchLoaders || false) !== false) {
    insertCssLink('/genealabs-laravel-casts/bootstrap-switch.css');
    $.getScript('/genealabs-laravel-casts/bootstrap-switch.js', function () {
        setTimeout(function () {
            window.genealabsLaravelCasts.switchLoaders.forEach(function (switchLoader) {
                switchLoader();
            });
        }, 100);
    });
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
