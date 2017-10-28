<?php namespace GeneaLabs\LaravelCasts;

abstract class ValuelessInput extends Component
{
    protected function renderBaseControl() : string
    {
        return app('form')->callParentMethod(
            $this->type,
            $this->name,
            $this->options
        );
    }
}
