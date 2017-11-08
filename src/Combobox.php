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
        $options['class'] = ($options['class'] ?? '');
        $options['subFormClass'] = ($options['subFormClass'] ?? '');

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
        $this->attributes['options'] = $options;
        $this->excludedKeys = $this->excludedKeys->merge(collect([
            'list' => '',
            'selected' => '',
        ]));
    }

    protected function renderBaseControl() : string
    {
        return app('form')->callParentMethod(
            'select',
            $this->name,
            $this->list,
            $this->value,
            $this->options,
            $this->optionOptions
        );
    }

    public function getOptionsAttribute() : array
    {
        $options = collect($this->attributes['options']);
        $options = $options->merge(collect(parent::getOptionsAttribute()))->toArray();

        return collect($options)->map(function ($value, $key) {
            if ($key !== 'class') {
                return trim($value);
            }

            return collect(explode(' ', $value))
                ->filter(function ($class) {
                    return ($this->excludedClasses->has($class) ? null : $class);
                })
                ->push('selectize')
                ->implode(' ');
        })
        ->filter(function ($value, $key) {
            return ($this->excludedKeys->has($key) ? null : $value);
        })
        ->unique()
        ->toArray();
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
