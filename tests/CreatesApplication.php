<?php namespace GeneaLabs\LaravelCasts\Tests;

use GeneaLabs\LaravelCasts\Providers\Service as LaravelCastsService;

trait CreatesApplication
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelCastsService::class,
        ];
    }
}
