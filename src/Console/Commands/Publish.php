<?php namespace GeneaLabs\LaravelCasts\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel;
use GeneaLabs\LaravelCasts\Providers\LaravelCastsService;

class Publish extends Command
{
    protected $signature = 'casts:publish {--assets}';
    protected $description = 'Publish various assets of the Laravel Casts package.';

    public function handle()
    {
        if ($this->option('assets')) {
            $this->call('vendor:publish', [
                '--provider' => LaravelCastsService::class,
                '--tag' => ['assets'],
                '--force' => true,
            ]);
        }
    }
}
