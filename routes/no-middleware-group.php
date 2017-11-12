<?php

use \GeneaLabs\LaravelCasts\Http\Controllers\Bootstrap3;
use \GeneaLabs\LaravelCasts\Http\Controllers\Bootstrap4;
use \GeneaLabs\LaravelCasts\Http\Controllers\Tailwind;
use \GeneaLabs\LaravelCasts\Http\Controllers\Vanilla;

Route::group(['prefix' => 'genealabs/laravel-casts/examples'], function () {
    Route::resource('bootstrap3', Bootstrap3::class)->only(['index', 'store']);
    Route::resource('bootstrap4', Bootstrap4::class)->only(['index', 'store']);
    Route::resource('tailwind', Tailwind::class)->only(['index', 'store']);
    Route::resource('vanilla', Vanilla::class)->only(['index', 'store']);
});
