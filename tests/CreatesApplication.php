<?php namespace GeneaLabs\LaravelCasts\Tests;

use GeneaLabs\LaravelCasts\Providers\Service as LaravelCastsService;
use Orchestra\Database\ConsoleServiceProvider;

trait CreatesApplication
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelCastsService::class,
            ConsoleServiceProvider::class,
        ];
    }
}
