<?php namespace GeneaLabs\LaravelCasts;

class Combobox extends Dropdown
{
    public function __construct(
        string $name,
        array $list = [],
        $value = null,
        array $options = [],
        array $optionOptions = []
    ) {
        $options['multiple'] = array_key_exists('multiple', $options) ? 'multiple' : null;

        if (array_key_exists('subFormAction', $options)) {
            $options['subFormMethod'] = $options['subFormMethod'] ?? 'POST';
            $options['subFormClass'] = '.' . str_random(6);
            $options['subFormResponseObjectPrimaryKey'] = $options['subFormResponseObjectPrimaryKey'] ?? 'id';
        }

        $options['list'] = collect($list)->transform(function ($item, $index) {
            return [
                'text' => $item,
                'value' => $index,
            ];
        })->values()->toJson();
        $options['selected'] = collect($value)->transform(function ($item, $index) {
            return [
                'text' => $item,
                'value' => $index,
            ];
        })->values()->toJson();
        array_filter($options);

        parent::__construct($name, $list, $value, $options, $optionOptions);

        $this->excludedKeys = collect([
            'label' => '',
            'list' => '',
            'selected' => '',
        ]);
    }

    public function getHtmlAttribute() : string
    {
        $html = parent::getHtmlAttribute();

        if (array_key_exists('subFormAction', $this->attributes['options'])) {
            $html .= (new Subform($this->attributes['options']))->html;
        }

        return $html;
    }
}
