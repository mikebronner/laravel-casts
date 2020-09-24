window.flatpickr = require("flatpickr");

function getCssProperty(element, property)
{
    return window.getComputedStyle(element, null).getPropertyValue(property);
}

function fontAwesomeIsLoaded()
{
    var span = document.createElement('span');
    var fontAwesomeIsLoaded = false;

    span.className = 'fa';
    span.style.display = 'none';
    document.body.insertBefore(span, document.body.firstChild);
    fontAwesomeIsLoaded = (getCssProperty(span, 'font-family') === 'FontAwesome');
    document.body.removeChild(span);

    return fontAwesomeIsLoaded;
}

function insertCssLink(path) {
    var head = document.getElementsByTagName('head')[0];
    var link = document.createElement('link');

    link.rel = 'stylesheet preload';
    link.as = 'style';
    link.href = path;
    head.appendChild(link);
}

if (! fontAwesomeIsLoaded()) {
    insertCssLink('/vendor/laravel-casts/font-awesome.css');
}

window['genealabsLaravelCasts'] = window.genealabsLaravelCasts || {};

if ((window.genealabsLaravelCasts.dateTimeLoaders || false) !== false) {
    if (typeof moment === 'undefined') {
        $.getScript('/vendor/laravel-casts/moment.js', function() {});
    }

    if (window.genealabsLaravelCasts.framework === "tailwind") {
        insertCssLink('/vendor/laravel-casts/datetimepicker.css');
        $.getScript('/vendor/laravel-casts/datetimepicker.js', function() {
            window.genealabsLaravelCasts.dateTimeLoaders.forEach(function(dateTimeLoader) {
                dateTimeLoader();
            });
        });
    }
}

if ((window.genealabsLaravelCasts.signatureLoaders || false) !== false) {
    insertCssLink('/vendor/laravel-casts/signature-pad.css');
    $.getScript('/vendor/laravel-casts/signature-pad.js', function() {
        window.genealabsLaravelCasts.signatureLoaders.forEach(function(signatureLoader) {
            signatureLoader();
        });
    });
}
