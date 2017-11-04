<?php namespace GeneaLabs\LaravelCasts;

class SelectRange extends Dropdown
{
    public function __construct(
        string $name,
        $start,
        $end,
        $value = null,
        array $options = [],
        array $optionOptions = []
    ) {
        $list = range($start, $end);

        parent::__construct($name, $list, $value, $options, $optionOptions);
    }

    public function getTypeAttribute() : string
    {
        return 'select';
    }
}
