<?php namespace GeneaLabs\LaravelCasts;

class SelectRangeWithInterval extends Dropdown
{
    public function __construct(
        string $name,
        $start,
        $end,
        $interval,
        $value = null,
        array $options = [],
        array $optionOptions = []
    ) {
        $values = range($start, $end, $interval);
        $keys = array_map('strval', $values);
        $list = array_combine($keys, $values);

        parent::__construct($name, $list, $value, $options, $optionOptions);
    }

    public function getTypeAttribute() : string
    {
        return 'select';
    }
}
