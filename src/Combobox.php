<?php namespace GeneaLabs\LaravelCasts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Combobox extends Dropdown
{
    public function __construct(
        string $name,
        array $list = [],
        Model $value = null,
        array $options = [],
        array $optionOptions = []
    ) {
        parent::__construct($name, $list, $value, $options, $optionOptions);

        if (array_key_exists('multiple', $this->attributes['options'])) {
            $this->attributes['options']['multiple'] = 'multiple';
        }

        $this->attributes['options']['class'] = ($this->attributes['options']['class'] ?? '') . ' selectize';

        if (array_key_exists('subFormAction', $this->attributes['options'])) {
            $this->attributes['options']['subFormMethod'] = $this->attributes['options']['subFormMethod'] ?? 'POST';
            $this->attributes['options']['subFormClass'] = '.' . Str::random(6);
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
        $this->excludedKeys = collect([
            'label' => '',
            'list' => '',
            'selected' => '',
            'subFormClass' => '',
            'subFormAction' => '',
            'subFormMethod' => '',
            'subFormFieldName' => '',
            'subFormBlade' => '',
            'subFormHtml' => '',
            'subFormTitle' => '',
            'subFormResponseObjectPrimaryKey' => '',
        ]);
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
}
