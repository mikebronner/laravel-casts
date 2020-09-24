<?php namespace GeneaLabs\LaravelCasts\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel;
use GeneaLabs\LaravelCasts\Providers\Service;
use File;

class Publish extends Command
{
    protected $signature = 'casts:publish {--assets} {--config}';
    protected $description = 'Publish various assets of the Laravel Casts package.';

    public function handle()
    {
        if ($this->option('assets')) {
            $this->delTree(public_path('vendor/laravel-casts'));
            $this->call('vendor:publish', [
                '--provider' => Service::class,
                '--tag' => ['assets'],
                '--force' => true,
            ]);
        }

        if ($this->option('config')) {
            $this->call('vendor:publish', [
                '--provider' => Service::class,
                '--tag' => ['config'],
                '--force' => true,
            ]);
        }
    }

    private function delTree($folder)
    {
        if (! is_dir($folder)) {
            return false;
        }

        $files = array_diff(scandir($folder), ['.','..']);

        foreach ($files as $file) {
            is_dir("$folder/$file") ? $this->delTree("$folder/$file") : unlink("$folder/$file");
        }

        return rmdir($folder);
    }
}
