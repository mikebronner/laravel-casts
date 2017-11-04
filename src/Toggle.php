<?php namespace GeneaLabs\LaravelCasts;

abstract class Toggle extends Component
{
    protected $isChecked = false;

    public function __construct(
        string $name,
        $value = null,
        bool $isChecked = null,
        array $options = []
    ) {
        parent::__construct($name, $value, $options);

        $this->isChecked = $isChecked;
        $this->classes = '';
        $this->excludedKeys = $this->excludedKeys->merge(collect([
            'placeholder' => '',
        ]));

        if ($this->framework === 'bootstrap4') {
            $this->classes = 'form-check-input';
        }
    }

    protected function renderBaseControl() : string
    {
        $label = $this->attributes['options']['label'] ?? ucwords($this->name);

        return app('form')->callParentMethod(
            $this->type,
            $this->name,
            $this->value,
            $this->isChecked,
            $this->options
        ) .
        " {$label}";
    }
}
