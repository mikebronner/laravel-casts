<?php

Route::group(['middleware' => ['web']], function () {
    require('no-middleware-group.php');
});
