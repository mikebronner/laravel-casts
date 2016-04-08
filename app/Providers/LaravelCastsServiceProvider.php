<?php namespace GeneaLabs\LaravelCasts\Providers;

use GeneaLabs\LaravelCasts\Facades\FormFacade;
use GeneaLabs\LaravelCasts\Facades\HtmlFacade;
use GeneaLabs\LaravelCasts\FormBuilder;
use GeneaLabs\LaravelCasts\HtmlBuilder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Blade;
use Exception;

class LaravelCastsServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/genealabs-laravel-casts.php' => config_path('genealabs-laravel-casts.php'),
        ], 'config');

        $this->registerBladeDirective('form');
        $this->registerBladeDirective('modelForm');
        $this->registerBladeDirective('email');
        $this->registerBladeDirective('url');
        $this->registerBladeDirective('date');
        $this->registerBladeDirective('password');
        $this->registerBladeDirective('file');
        $this->registerBladeDirective('textarea');
        $this->registerBladeDirective('checkbox');
        $this->registerBladeDirective('submit');
        $this->registerBladeDirective('cancel');
        $this->registerBladeDirective('select');
        $this->registerBladeDirective('selectRangeWithInterval');
        $this->registerBladeDirective('endform');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/genealabs-laravel-casts.php', 'genealabs-laravel-casts');

        $this->registerHtmlBuilder();
        $this->registerFormBuilder();
        AliasLoader::getInstance()->alias('Form', FormFacade::class);
        AliasLoader::getInstance()->alias('HTML', HtmlFacade::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['genealabs-laravel-casts'];
    }

    /**
     * Register the HTML builder instance.
     *
     * @return void
     */
    private function registerHtmlBuilder()
    {
        $this->app->singleton('html', function($app)
        {
            return new HtmlBuilder($app['url'], $app['view']);
        });
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    private function registerFormBuilder()
    {
        $this->app->singleton('form', function($app)
        {
            return new FormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->getToken());
        });
    }

    private function registerBladeDirective($formMethod)
    {
        if (array_key_exists($formMethod, Blade::getCustomDirectives())) {
            throw new Exception("Blade directive '{$formMethod}' is already registered.");
        }

        app('blade.compiler')->directive($formMethod, function ($parameters) {
            $parameters = (strlen(trim($parameters)) === 0 ?: '()');

            return eval("return app('form')->{$formMethod}{$parameters};");
        });
    }
}
