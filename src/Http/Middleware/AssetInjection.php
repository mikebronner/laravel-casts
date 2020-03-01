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
        $castsScripts = '<script src="' . asset('genealabs-laravel-casts/app.js') . '"></script></body>';
        $livewireScripts = (new LivewireManager)->scripts();
        $livewireStyles = (new LivewireManager)->styles();

        $html = new HtmlPageCrawler($content);

        if ($html->filter("html > head")->count()) {
            $html->filter("html > head")->append($livewireStyles);
            $html->filter("html > head")->append($livewireStyles);
            $html->filter("html > body")->append($livewireScripts);
            $html->filter("html > body")->append($castsScripts);
            $content = $html->saveHTML();
        }

        $response->setContent($content);

        return $response;
    }
}
