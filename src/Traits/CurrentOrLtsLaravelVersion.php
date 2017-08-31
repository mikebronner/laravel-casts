<?php namespace GeneaLabs\LaravelCasts\Traits;

use BadMethodCallException;

trait CurrentOrLtsLaravelVersion
{
    public function __call($method, $arguments)
    {
        if (method_exists($this, 'hasComponent') && static::hasComponent($method)) {
            return $this->renderComponent($method, $arguments);
        }

        $laravelVersion = app()->version();
        $currentOrLts = starts_with($laravelVersion, '5.3.') || starts_with($laravelVersion, '5.4.') || starts_with($laravelVersion, '5.5.')
            ? 'ForLaravelCurrent'
            : (starts_with($laravelVersion, '5.1.') ? 'ForLaravelLts' : '');

        if (method_exists($this, "{$method}{$currentOrLts}")) {
            return call_user_func_array([$this, "{$method}{$currentOrLts}"], $arguments);
        }


        throw new BadMethodCallException("Method '{$method}' is not configured for this version of Laravel.");
    }
}
