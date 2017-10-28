<?php namespace GeneaLabs\LaravelCasts;

class Subform extends Component
{
    public function __construct(
        array $options = []
    ) {
        parent::__construct('', null, $options);
    }

    protected function renderBaseControl() : string
    {
        return '';
    }
}
