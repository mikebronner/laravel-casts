<?php namespace GeneaLabs\LaravelCasts\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AssetInjection
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (is_a($response, RedirectResponse::class)) {
            return $response;
        }

        $content = $response->content();

        if (preg_match('/<form/', $content)) {
            return $response->setContent(str_replace(
                '</body>',
                '<script src="' . asset('genealabs-laravel-casts/app.js') . '"></script></body>',
                $content
            ));
        }

        return $response;
    }
}
