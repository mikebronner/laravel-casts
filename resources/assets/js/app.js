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

    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = path;
    link.media = 'all';
    head.appendChild(link);
}

if (! fontAwesomeIsLoaded()) {
    insertCssLink('/genealabs-laravel-casts/font-awesome.css');
}

window['genealabsLaravelCasts'] = window.genealabsLaravelCasts || {};

if ((window.genealabsLaravelCasts.dateTimeLoaders || false) !== false) {
    if (typeof moment === 'undefined') {
        $.getScript('/genealabs-laravel-casts/moment.js', function() {});
    }

    if (window.genealabsLaravelCasts.framework === "tailwind") {
        insertCssLink('/genealabs-laravel-casts/datetimepicker.css');
        $.getScript('/genealabs-laravel-casts/datetimepicker.js', function() {
            window.genealabsLaravelCasts.dateTimeLoaders.forEach(function(dateTimeLoader) {
                dateTimeLoader();
            });
        });
    }
}

if ((window.genealabsLaravelCasts.signatureLoaders || false) !== false) {
    insertCssLink('/genealabs-laravel-casts/signature-pad.css');
    $.getScript('/genealabs-laravel-casts/signature-pad.js', function() {
        window.genealabsLaravelCasts.signatureLoaders.forEach(function(signatureLoader) {
            signatureLoader();
        });
    });
}
