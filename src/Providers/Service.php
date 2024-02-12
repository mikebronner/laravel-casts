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
use GeneaLabs\LaravelCasts\View\Components\Card;
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
use GeneaLabs\LaravelCasts\View\Components\Signature;
use GeneaLabs\LaravelCasts\View\Components\State;
use GeneaLabs\LaravelCasts\View\Components\Submit;
use GeneaLabs\LaravelCasts\View\Components\Tel;
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'laravel-forms');
        $this->publishes([
            __DIR__ . '/../../public/' => public_path('vendor/laravel-casts'),
        ], 'assets');
        $configPath = __DIR__ . '/../../config/genealabs-laravel-casts.php';
        $this->publishes([
            $configPath => config_path('genealabs-laravel-casts.php')
        ], 'config');
        $this->mergeConfigFrom($configPath, 'laravel-forms');

        $this->registerLivewireComponents();

        FacadesBlade::component('form', Form::class);
        $this->loadViewComponentsAs(
            'form',
            [
                Button::class,
                Card::class,
                Checkbox::class,
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
                LaravelCastsCombobox::class,
                Money::class,
                Month::class,
                Number::class,
                Password::class,
                Radio::class,
                Range::class,
                Select::class,
                Signature::class,
                State::class,
                Submit::class,
                Tel::class,
                Text::class,
                Textarea::class,
                Time::class,
                TinyMce::class,
                Toggle::class,
                Trix::class,
            ],
        );
    }

    public function register()
    {
        if (app()->environment('testing', 'development', 'local')) {
            $routesPath = __DIR__ . '/../../routes/web.php';

            require($routesPath);
        }

        $this->commands(Publish::class);
        app(Kernel::class)->pushMiddleware(AssetInjection::class);
    }

    public function provides() : array
    {
        return ['laravel-forms'];
    }

    private function registerLivewireComponents() : void
    {
        Livewire::component(
            "laravel-forms::combobox",
            Combobox::class
        );
    }
}
