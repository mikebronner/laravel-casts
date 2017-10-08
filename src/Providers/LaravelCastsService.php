<?php namespace GeneaLabs\LaravelCasts\Providers;

use Blade;
use Exception;
use GeneaLabs\LaravelCasts\Facades\FormFacade;
use GeneaLabs\LaravelCasts\Facades\HtmlFacade;
use GeneaLabs\LaravelCasts\FormBuilder;
use Collective\Html\HtmlBuilder;
use GeneaLabs\LaravelCasts\Console\Commands\Publish;
use GeneaLabs\LaravelCasts\Http\Middleware\AssetInjection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class LaravelCastsService extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        if (! headers_sent()) {
            header('Link: <' . url('/genealabs-laravel-casts/app.js') . '>; rel=preload; as=script', false);
            header('Link: <' . url('/genealabs-laravel-casts/bootstrap3.js') . '>; rel=preload; as=script', false);
            header('Link: <' . url('/genealabs-laravel-casts/bootstrap3.css') . '>; rel=preload; as=style', false);
            header('Link: <' . url('/genealabs-laravel-casts/bootstrap4.js') . '>; rel=preload; as=script', false);
            header('Link: <' . url('/genealabs-laravel-casts/bootstrap4.css') . '>; rel=preload; as=style', false);
            header('Link: <' . url('/genealabs-laravel-casts/bootstrap-switch.js') . '>; rel=preload; as=script', false);
            header('Link: <' . url('/genealabs-laravel-casts/bootstrap3-datetimepicker.js') . '>; rel=preload; as=script', false);
            header('Link: <' . url('/genealabs-laravel-casts/bootstrap3-datetimepicker.css') . '>; rel=preload; as=style', false);
            header('Link: <' . url('/genealabs-laravel-casts/bootstrap4-datetimepicker.js') . '>; rel=preload; as=script', false);
            header('Link: <' . url('/genealabs-laravel-casts/bootstrap4-datetimepicker.css') . '>; rel=preload; as=style', false);
        }

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'genealabs-laravel-casts');
        $this->publishes([
            __DIR__ . '/../../public/' => public_path('genealabs-laravel-casts'),
        ], 'assets');
        $configPath = __DIR__ . '/../../config/genealabs-laravel-casts.php';
        $this->publishes([
            $configPath => config_path('genealabs-laravel-casts.php')
        ], 'config');
        $this->mergeConfigFrom($configPath, 'genealabs-laravel-casts');

        $this->registerBladeDirective('form');
        $this->registerBladeDirective('endSubForm');
        $this->registerBladeDirective('model');
        $this->registerBladeDirective('token');
        $this->registerBladeDirective('hidden');
        $this->registerBladeDirective('label');
        $this->registerBladeDirective('text');
        $this->registerBladeDirective('number');
        $this->registerBladeDirective('email');
        $this->registerBladeDirective('url');
        $this->registerBladeDirective('date');
        $this->registerBladeDirective('datetime');
        $this->registerBladeDirective('password');
        $this->registerBladeDirective('file');
        $this->registerBladeDirective('textarea');
        $this->registerBladeDirective('checkbox');
        $this->registerBladeDirective('switch');
        $this->registerBladeDirective('radio');
        $this->registerBladeDirective('button');
        $this->registerBladeDirective('buttonGroup');
        $this->registerBladeDirective('endButtonGroup');
        $this->registerBladeDirective('submit');
        $this->registerBladeDirective('cancel');
        $this->registerBladeDirective('select');
        $this->registerBladeDirective('selectMonths');
        $this->registerBladeDirective('selectRange');
        $this->registerBladeDirective('selectRangeWithInterval');
        $this->registerBladeDirective('combobox');
        $this->registerBladeDirective('signature');
        $this->registerBladeDirective('staticText');
        $this->registerBladeDirective('close', 'endform');
        $this->registerComponents();
    }

    public function register()
    {
        if (app()->environment('testing')) {
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
        return ['genealabs-laravel-casts'];
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
            throw new Exception("Blade directive '{$alias}' is already registered.");
        }

        app('blade.compiler')->directive($alias, function ($parameters) use ($formMethod) {
            $parameters = trim($parameters, "()");

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
            "bootstrap3Control",
            "genealabs-laravel-casts::components.bootstrap3.control",
            $options
        );

        app('form')->component(
            "bootstrap4Control",
            "genealabs-laravel-casts::components.bootstrap4.control",
            $options
        );

        app('form')->component(
            "vanillaControl",
            "genealabs-laravel-casts::components.vanilla.control",
            $options
        );
    }
}
