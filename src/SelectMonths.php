<?php namespace GeneaLabs\LaravelCasts;

class SelectMonths extends Dropdown
{
    public function __construct(
        string $name,
        $value = null,
        array $options = [],
        array $optionOptions = []
    ) {
        $list = [
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        if (($options['optionsFormat'] ?? '') === 'slugs') {
            $keys = array_map('str_slug', array_values($list));
            $list = array_combine($keys, array_values($list));
        }

        if (($options['optionsFormat'] ?? '') === 'names') {
            $list = array_combine(array_values($list), array_values($list));
        }

        if (($options['optionsFormat'] ?? '') === 'names') {
            $list = [
                'January' => 'January',
                'February' => 'February',
                'March' => 'March',
                'April' => 'April',
                'May' => 'May',
                'June' => 'June',
                'July' => 'July',
                'August' => 'August',
                'September' => 'September',
                'October' => 'October',
                'November' => 'November',
                'December' => 'December',
            ];
        }

        parent::__construct($name, $list, $value, $options, $optionOptions);
    }

    public function getTypeAttribute() : string
    {
        return 'select';
    }
}
