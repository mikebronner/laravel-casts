<?php namespace GeneaLabs\LaravelCasts\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class Vue extends Controller
{
    public function index() : View
    {
        config(['genealabs-laravel-casts.framework' => 'vue']);

        return view('genealabs-laravel-casts::examples.vue');
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function store(FormsExample $request) : RedirectResponse
    {
        return redirect('genealabs/laravel-casts/examples/vue');
    }
}
