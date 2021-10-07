<?php

namespace GeneaLabs\LaravelCasts\Providers;

use Blade;
use Collective\Html\HtmlBuilder;
use Exception;
use GeneaLabs\LaravelCasts\Console\Commands\Publish;
use GeneaLabs\LaravelCasts\FormBuilder;
use GeneaLabs\LaravelCasts\Http\Livewire\Combobox;
use GeneaLabs\LaravelCasts\Http\Middleware\AssetInjection;
use GeneaLabs\LaravelCasts\View\Components\Button;
use GeneaLabs\LaravelCasts\View\Components\Checkbox;
use GeneaLabs\LaravelCasts\View\Components\Ckeditor;
use GeneaLabs\LaravelCasts\View\Components\Color;
use GeneaLabs\LaravelCasts\View\Components\Combobox as LaravelCastsCombobox;
use GeneaLabs\LaravelCasts\View\Components\Date;
use GeneaLabs\LaravelCasts\View\Components\Datetime;
use GeneaLabs\LaravelCasts\View\Components\Email;
use GeneaLabs\LaravelCasts\View\Components\Errors;
use GeneaLabs\LaravelCasts\View\Components\File;
use GeneaLabs\LaravelCasts\View\Components\Form;
use GeneaLabs\LaravelCasts\View\Components\Group;
use GeneaLabs\LaravelCasts\View\Components\Gutenberg;
use GeneaLabs\LaravelCasts\View\Components\Hidden;
use GeneaLabs\LaravelCasts\View\Components\Image;
use GeneaLabs\LaravelCasts\View\Components\Label;
use GeneaLabs\LaravelCasts\View\Components\Money;
use GeneaLabs\LaravelCasts\View\Components\Month;
use GeneaLabs\LaravelCasts\View\Components\Number;
use GeneaLabs\LaravelCasts\View\Components\Password;
use GeneaLabs\LaravelCasts\View\Components\Radio;
use GeneaLabs\LaravelCasts\View\Components\Range;
use GeneaLabs\LaravelCasts\View\Components\Select;
use GeneaLabs\LaravelCasts\View\Components\Submit;
use GeneaLabs\LaravelCasts\View\Components\Text;
use GeneaLabs\LaravelCasts\View\Components\Textarea;
use GeneaLabs\LaravelCasts\View\Components\Time;
use GeneaLabs\LaravelCasts\View\Components\TinyMce;
use GeneaLabs\LaravelCasts\View\Components\Toggle;
use GeneaLabs\LaravelCasts\View\Components\Trix;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade as FacadesBlade;
use Illuminate\Support\ServiceProvider;
use Livewire;

class Service extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        // if (! headers_sent()) {
            // $this->registerPreLoadHeader(url('/vendor/laravel-casts/app.js'));
        // }

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'laravel-forms');
        $this->publishes([
            __DIR__ . '/../../public/' => public_path('vendor/laravel-casts'),
        ], 'assets');
        $configPath = __DIR__ . '/../../config/genealabs-laravel-casts.php';
        $this->publishes([
            $configPath => config_path('genealabs-laravel-casts.php')
        ], 'config');
        $this->mergeConfigFrom($configPath, 'laravel-forms');

        // $this->registerBladeDirective('button');
        // $this->registerBladeDirective('buttonGroup');
        // $this->registerBladeDirective('cancelButton');
        // $this->registerBladeDirective('checkbox');
        // $this->registerBladeDirective('close', 'endform');
        // $this->registerBladeDirective('color');
        // $this->registerBladeDirective('combobox');
        // $this->registerBladeDirective('date');
        // $this->registerBladeDirective('datetime');
        // $this->registerBladeDirective('email');
        // $this->registerBladeDirective('endButtonGroup');
        // $this->registerBladeDirective('endsubform');
        // $this->registerBladeDirective('errors');
        // $this->registerBladeDirective('file');
        // $this->registerBladeDirective('form');
        // $this->registerBladeDirective('hidden');
        // $this->registerBladeDirective('label');
        // $this->registerBladeDirective('model');
        // $this->registerBladeDirective('month');
        // $this->registerBladeDirective('number');
        // $this->registerBladeDirective('password');
        // $this->registerBladeDirective('radio');
        // $this->registerBladeDirective('range');
        // $this->registerBladeDirective('search');
        // $this->registerBladeDirective('select');
        // $this->registerBladeDirective('selectMonths');
        // $this->registerBladeDirective('selectRange');
        // $this->registerBladeDirective('selectRangeWithInterval');
        // $this->registerBladeDirective('selectWeekdays');
        // $this->registerBladeDirective('signature');
        // $this->registerBladeDirective('staticText');
        // $this->registerBladeDirective('subform');
        // $this->registerBladeDirective('submit');
        // $this->registerBladeDirective('switch');
        // $this->registerBladeDirective('tel');
        // $this->registerBladeDirective('text');
        // $this->registerBladeDirective('textarea');
        // $this->registerBladeDirective('token');
        // $this->registerBladeDirective('url');
        // $this->registerBladeDirective('week');
        // $this->registerComponents();
        $this->registerLivewireComponents();

        FacadesBlade::component('form', Form::class);
        $this->loadViewComponentsAs(
            'form',
            [
                Button::class,
                Checkbox::class,
                LaravelCastsCombobox::class,
                Ckeditor::class,
                Color::class,
                Date::class,
                Datetime::class,
                Email::class,
                Errors::class,
                File::class,
                Group::class,
                Gutenberg::class,
                Hidden::class,
                Image::class,
                Label::class,
                Money::class,
                Month::class,
                Number::class,
                Password::class,
                Radio::class,
                Range::class,
                Select::class,
                Submit::class,
                Toggle::class,
                Text::class,
                Textarea::class,
                Time::class,
                TinyMce::class,
            ],
        );
    }

    public function register()
    {
        if (app()->environment('testing', 'development', 'local')) {
            $routesPath = __DIR__ . '/../../routes/web.php';

            require($routesPath);
        }

        $this->registerHtmlBuilder();
        $this->registerFormBuilder();
        $this->commands(Publish::class);
        app(Kernel::class)->pushMiddleware(AssetInjection::class);
    }

    public function provides() : array
    {
        return ['laravel-forms'];
    }

    private function registerPreLoadHeader(string $url)
    {
        header("Link: <{$url}>; rel=preload; as=script", false);
    }

    private function registerHtmlBuilder()
    {
        $this->app->singleton('html', function ($app) {
            return new HtmlBuilder($app['url'], $app['view']);
        });
    }

    private function registerFormBuilder()
    {
        $this->app->singleton('form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token());

            return $form->setSessionStore($app['session.store']);
        });
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    private function registerBladeDirective($formMethod, $alias = null)
    {
        $alias = $alias ?: $formMethod;

        if (array_key_exists($alias, Blade::getCustomDirectives())) {
            return;
            // throw new Exception("Blade directive '{$alias}' is already registered.");
        }

        app('blade.compiler')->directive($alias, function ($parameters) use ($formMethod) {
            $matches = [];
            preg_match('/(\(([^()]|(?R))*\))/', $parameters, $matches);

            if (($matches[0] ?? '') === $parameters) {
                $parameters = substr($parameters, 1, -1);
            }

            return "<?php echo app('form')->{$formMethod}({$parameters}); ?>";
        });
    }

    private function registerComponents()
    {
        $options = [
            'type',
            'controlHtml',
            'name',
            'value' => null,
            'options' => [],
            'fieldWidth' => 9,
            'labelWidth' => 3,
            'isHorizontal' => false,
            'isInline' => false,
            'isInButtonGroup' => false,
            'errors' => [],
        ];

        app('form')->component(
            "tailwindControl",
            "genealabs-laravel-casts::components.tailwind.control",
            $options
        );

        app('form')->component(
            "vanillaControl",
            "genealabs-laravel-casts::components.vanilla.control",
            $options
        );
    }

    private function registerLivewireComponents() : void
    {
        Livewire::component(
            "laravel-forms::combobox",
            Combobox::class
        );
    }
}
