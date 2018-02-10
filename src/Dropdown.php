<?php namespace GeneaLabs\LaravelCasts;

abstract class Dropdown extends Component
{
    protected $list;
    protected $optionGroupOptions;
    protected $optionOptions;

    public function __construct(
        string $name,
        array $list = [],
        $value = null,
        array $options = [],
        array $optionOptions = [],
        array $optionGroupOptions = []
    ) {
        parent::__construct($name, $value, $options);

        $this->list = $list;
        $this->optionGroupOptions = $optionGroupOptions;
        $this->optionOptions = $optionOptions;

        $this->excludedKeys = $this->excludedKeys->merge(collect([
            'list' => '',
        ]));

        if ($this->framework === 'bootstrap4' && ! collect($this->options)->has('multiple')) {
            $this->classes .= ' custom-select';
        }
    }

    protected function disablePlaceholderOption(string $html) : string
    {
        if ($this->options['placeholder'] ?? false) {
            $html = str_replace(
                '<option selected="selected" value="">' .
                $this->options['placeholder'] .
                '</option>',
                '<option selected="selected" value="" disabled="disabled">' .
                $this->options['placeholder'] .
                '</option>',
                $html
            );

            $html = str_replace(
                '<option value="">' .
                $this->options['placeholder'] .
                '</option>',
                '<option value="" disabled="disabled">' .
                $this->options['placeholder'] .
                '</option>',
                $html
            );

            $html = str_replace(
                '<option value="" hidden="hidden">' .
                $this->options['placeholder'] .
                '</option>',
                '<option value="" disabled="disabled">' .
                $this->options['placeholder'] .
                '</option>',
                $html
            );
        }

        return $html;
    }

    protected function renderBaseControl() : string
    {
        $html = app('form')->callParentMethod(
            $this->type,
            $this->name,
            $this->list,
            $this->value,
            $this->options,
            $this->optionOptions,
            $this->optionGroupOptions
        );

        return $this->disablePlaceholderOption($html);
    }

    public function getTypeAttribute() : string
    {
        $type = parent::getTypeAttribute();

        return $type === 'dropdown' ? 'select' : $type;
    }
}
