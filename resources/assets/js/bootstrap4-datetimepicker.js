global.moment = require('moment');
global.loadDateTimePickerPlugin = function (jQuery) {
    require('tempusdominus-bootstrap-4');

    return jQuery;
}
