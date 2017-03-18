<?php namespace GeneaLabs\LaravelCasts\Http\Middleware;

use Closure;

class AssetInjection
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $content = $response->content();

        if (preg_match('/<form.*?framework=".*/', $content)) {
            return $response->setContent(str_replace(
                '</body>',
                '<script src="' . asset('genealabs-laravel-casts/app.js') . '"></script></body>',
                $content
            ));
        }

        return $response;
    }
}
