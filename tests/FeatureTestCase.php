<?php namespace GeneaLabs\LaravelCasts\Tests;

use GeneaLabs\LaravelCasts\Providers\LaravelCastsService;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Laravel\BrowserKitTesting\TestCase;

abstract class FeatureTestCase extends TestCase
{
    public $baseUrl = 'http://localhost';

    public function createApplication() : Application
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        $app->register(LaravelCastsService::class);

        return $app;
    }
}
