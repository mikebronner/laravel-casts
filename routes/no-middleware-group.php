<?php

use GeneaLabs\LaravelCasts\Html\Controllers\Bootstrap3;
use GeneaLabs\LaravelCasts\Html\Controllers\Bootstrap4;
use GeneaLabs\LaravelCasts\Html\Controllers\Vanilla;

Route::group(['prefix' => 'genealabs/laravel-casts/examples'], function () {
    Route::resource('bootstrap3', Bootstrap3::class)->only(['index', 'store']);
    Route::resource('bootstrap4', Bootstrap4::class)->only(['index', 'store']);
    Route::resource('vanilla', Vanilla::class)->only(['index', 'store']);
});
