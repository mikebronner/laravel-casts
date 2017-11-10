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
        parent::__construct($name, $list, $value, $options, $optionOptions);

        if (array_key_exists('multiple', $this->attributes['options'])) {
            $this->attributes['options']['multiple'] = 'multiple';
        }

        $this->attributes['options']['class'] = $this->attributes['options']['class'] ?? '';
        // $this->attributes['options']['subFormClass'] = $this->attributes['options']['subFormClass'] ?? '';

        if (array_key_exists('subFormAction', $this->attributes['options'])) {
            $this->attributes['options']['subFormMethod'] = $this->attributes['options']['subFormMethod'] ?? 'POST';
            $this->attributes['options']['subFormClass'] = '.' . str_random(6);
            $this->attributes['options']['subFormResponseObjectPrimaryKey'] = $this->attributes['options']['subFormResponseObjectPrimaryKey'] ?? 'id';
        }
        $this->attributes['options']['list'] = collect($list)->transform(function ($item, $index) {
            return [
                'text' => $item,
                'value' => $index,
            ];
        })->values()->toJson();
        $this->attributes['options']['selected'] = collect($value)->transform(function ($item, $index) {
            return [
                'text' => $item,
                'value' => $index,
            ];
        })->values()->toJson();
        // array_filter($this->attributes['options']);

        // dd($this->options);
        $this->excludedKeys = collect([
            'label' => '',
            'list' => '',
            'selected' => '',
        ]);
    }

    protected function renderBaseControl() : string
    {
        $options = $this->attributes['options'];
        unset($options['list']);

        if (! ($options['subFormAction'] ?? '')) {
            unset($options['subFormClass']);
            unset($options['subFormAction']);
            unset($options['subFormMethod']);
            unset($options['subFormFieldName']);
            unset($options['subFormBlade']);
        }

// dd($this->options, $this->attributes['options'], $options);
        return app('form')->callParentMethod(
            'select',
            $this->name,
            $this->list,
            $this->value,
            $this->attributes['options'],
            $this->optionOptions
        );
    }

    public function getOptionsAttribute() : array
    {
        $options = collect($this->attributes['options']);
        $options = $options->merge(collect(parent::getOptionsAttribute()))->toArray();
        $options = collect($options)->map(function ($value, $key) {
            if ($key !== 'class') {
                return trim($value);
            }

            return collect(explode(' ', $value))
                ->filter(function ($class) {
                    return ! $this->excludedClasses->has($class);
                })
                ->push('selectize')
                ->implode(' ');
        })
        ->filter(function ($value, $key) {
            return ! $this->excludedKeys->has($key);
        })
        ->unique()
        ->toArray();

        return $options;
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
