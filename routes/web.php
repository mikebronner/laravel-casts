<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/genealabs/laravel-casts/examples/bootstrap4', function () {
        return view('genealabs-laravel-casts::examples.bootstrap4');
    });
});
