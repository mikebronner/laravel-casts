<?php namespace GeneaLabs\LaravelCasts;

abstract class SpecialInput extends Component
{
    public function __construct(
        string $name,
        $value = null,
        array $options = []
    ) {
        parent::__construct($name, $value, $options);

        if ($this->framework === 'tailwind') {
            $this->classes .= ' form-input';
        }
    }

    protected function renderBaseControl() : string
    {
        return app('form')->callParentMethod(
            'input',
            $this->type,
            $this->name,
            $this->value,
            $this->options
        );
    }
}
