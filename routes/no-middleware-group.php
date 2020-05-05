<?php

use \GeneaLabs\LaravelCasts\Http\Controllers\Tailwind;
use \GeneaLabs\LaravelCasts\Http\Controllers\Vanilla;

Route::group(['prefix' => 'genealabs/laravel-casts/examples'], function () {
    Route::resource('tailwind', Tailwind::class)->only(['index', 'store']);
    Route::resource('vanilla', Vanilla::class)->only(['index', 'store']);
});
