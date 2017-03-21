<?php

use GeneaLabs\LaravelCasts\Http\Requests\FormsExample;

Route::get('/genealabs/laravel-casts/examples/bootstrap3', function () {
    config(['genealabs-laravel-casts.framework' => 'bootstrap3']);
    return view('genealabs-laravel-casts::examples.bootstrap3');
});

Route::post('/genealabs/laravel-casts/examples/bootstrap3', function (FormsExample $request) {
    return redirect('genealabs/laravel-casts/examples/bootstrap3');
});

Route::get('/genealabs/laravel-casts/examples/bootstrap4', function () {
    config(['genealabs-laravel-casts.framework' => 'bootstrap4']);
    return view('genealabs-laravel-casts::examples.bootstrap4');
});

Route::post('/genealabs/laravel-casts/examples/bootstrap4', function (FormsExample $request) {
    return redirect('genealabs/laravel-casts/examples/bootstrap4');
});

Route::get('/genealabs/laravel-casts/examples/vanilla', function () {
    config(['genealabs-laravel-casts.framework' => 'vanilla']);
    return view('genealabs-laravel-casts::examples.vanilla');
});

Route::post('/genealabs/laravel-casts/examples/vanilla', function (FormsExample $request) {
    return redirect('genealabs/laravel-casts/examples/vanilla');
});
