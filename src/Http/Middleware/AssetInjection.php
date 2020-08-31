<?php namespace GeneaLabs\LaravelCasts\Http\Middleware;

use Closure;
use Livewire\LivewireManager;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class AssetInjection
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (! method_exists($response, 'getContent')) {
            return $response;
        }

        $content = $response->getContent();

        if (! $content) {
            return $response;
        }

        $castsScripts = '<script src="' . asset('genealabs-laravel-casts/app.js') . '"></script></body>';
        $livewireScripts = (new LivewireManager)->scripts();
        $livewireStyles = (new LivewireManager)->styles();

        $html = (new HtmlPageCrawler)->create($content);

        if (! $html) {
            return $response;
        }

        if ($html->filter("html > head")->count()) {
            $html->filter("html > head")->append($livewireStyles);
            $html->filter("html > head")->append($livewireStyles);
            $html->filter("html > body")->append($livewireScripts);
            $html->filter("html > body")->append($castsScripts);
            $content = $html->saveHTML();
        }

        $original = $response->original;
        $response->setContent($content);
        $response->original = $original;

        return $response;
    }
}
