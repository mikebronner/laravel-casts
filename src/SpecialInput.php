<?php namespace GeneaLabs\LaravelCasts;

abstract class SpecialInput extends Component
{
    protected function renderBaseControl() : string
    {
        return app('form')->callParentMethod(
            'input',
            $this->type,
            $this->name,
            $this->value,
            $this->options
        );
    }
}
