<?php namespace GeneaLabs\LaravelCasts\Facades;

use Illuminate\Support\Facades\Facade;

class HtmlFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'html';
    }
}
