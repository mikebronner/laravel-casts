<?php

use GeneaLabs\LaravelCasts\Http\Requests\FormsExample;

Route::get('/genealabs/laravel-casts/examples/bootstrap3', function () {
    return view('genealabs-laravel-casts::examples.bootstrap3');
});

Route::post('/genealabs/laravel-casts/examples/bootstrap3', function (FormsExample $request) {
    return redirect('genealabs/laravel-casts/examples/bootstrap3');
});

Route::get('/genealabs/laravel-casts/examples/bootstrap4', function () {
    return view('genealabs-laravel-casts::examples.bootstrap4');
});

Route::post('/genealabs/laravel-casts/examples/bootstrap4', function (FormsExample $request) {
    return redirect('genealabs/laravel-casts/examples/bootstrap4');
});

Route::get('/genealabs/laravel-casts/examples/vanilla', function () {
    return view('genealabs-laravel-casts::examples.vanilla');
});

Route::post('/genealabs/laravel-casts/examples/vanilla', function (FormsExample $request) {
    return redirect('genealabs/laravel-casts/examples/vanilla');
});
