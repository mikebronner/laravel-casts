<?php namespace GeneaLabs\LaravelCasts;

class ButtonGroup extends Component
{
    public function __construct(array $options = [])
    {
        $label = $options['label'] ?? '';

        parent::__construct('', $label, $options);

        $this->classes = 'btn-group';
        $this->excludedKeys = $this->excludedKeys->merge(collect([
            'placeholder' => '',
        ]));
    }

    public function getTypeAttribute() : string
    {
        return 'buttonGroup';
    }

    protected function renderBaseControl() : string
    {
        $attributes = collect($this->options)
            ->map(function ($value, $attribute) {
                return "{$attribute}=\"{$value}\"";
            })
            ->implode(' ');

        return "<div {$attributes}>";
    }
}
