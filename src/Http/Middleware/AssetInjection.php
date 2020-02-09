<?php namespace GeneaLabs\LaravelCasts\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Livewire\LivewireManager;

class AssetInjection
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (! method_exists($response, 'getContent')) {
            return $response;
        }

        $content = $response->getContent();
        $castsScripts = '<script src="' . asset('genealabs-laravel-casts/app.js') . '"></script></body>';
        $livewireScripts = (new LivewireManager)->scripts();
        $livewireStyles = (new LivewireManager)->styles();

        if (! Str::contains($content, $livewireStyles)) {
            $content = str_replace("</head>", "{$livewireStyles}</head>", $content);
        }

        if (! Str::contains($content, $livewireScripts)) {
            $content = str_replace("</body>", "{$livewireScripts}</body>", $content);
        }

        if (! Str::contains($content, $castsScripts)) {
            $content = str_replace("</body>", "{$castsScripts}</body>", $content);
        }

        $response->setContent($content);

        return $response;
    }
}
