<?php namespace GeneaLabs\LaravelCasts;

class Subform extends Component
{
    public function __construct(
        string $name,
        $value = null,
        array $options = []
    ) {
        parent::__construct($name, $value, $options);
    }

    protected function renderBaseControl() : string
    {
        return '';
    }
}
