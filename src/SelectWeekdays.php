<?php namespace GeneaLabs\LaravelCasts;

class SelectWeekdays extends Dropdown
{
    public function __construct(
        string $name,
        $value = null,
        array $options = [],
        array $optionOptions = []
    ) {
        $list = [
            '1' => 'Sunday',
            '2' => 'Monday',
            '3' => 'Tuesday',
            '4' => 'Wednesday',
            '5' => 'Thursday',
            '6' => 'Friday',
            '7' => 'Saturday',
        ];

        if (($options['optionsFormat'] ?? '') === 'slugs') {
            $list = [
                'sunday' => 'Sunday',
                'monday' => 'Monday',
                'tuesday' => 'Tuesday',
                'wednesday' => 'Wednesday',
                'thursday' => 'Thursday',
                'friday' => 'Friday',
                'saturday' => 'Saturday',
            ];
        }

        parent::__construct($name, $list, $value, $options, $optionOptions);
    }

    public function getTypeAttribute() : string
    {
        return 'select';
    }
}
