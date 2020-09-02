<?php namespace GeneaLabs\LaravelCasts\Http\Middleware;

use Closure;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class AssetInjection
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // return $response;
        if (! method_exists($response, 'getContent')) {
            return $response;
        }

        $content = $response->getContent();

        if (! is_string($content)) {
            return $response;
        }

        $castsScripts = '<script src="' . asset('genealabs-laravel-casts/app.js') . '"></script>';

        $html = new HtmlPageCrawler($content);

        if ($this->isNotOnErrorPage($html)
            && $html->filter("html > head")->count()
        ) {
            $html->filter("html > body")->append($castsScripts);
            $content = $html->saveHTML();
        }

        $original = $response->original;
        $response->setContent($content);
        $response->original = $original;

        return $response;
    }

    protected function isNotOnErrorPage(string $html) : bool
    {
        return strpos($html, "window.Ignition") === false;
    }
}
