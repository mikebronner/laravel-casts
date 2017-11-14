<?php namespace GeneaLabs\LaravelCasts;

class Button extends Component
{
    public function __construct(string $value, array $options = [])
    {
        parent::__construct('', $value, $options);

        if (in_array($this->framework, ['bootstrap3', 'bootstrap4'])) {
            $this->classes = 'btn';
        }

        $this->excludedClasses = $this->excludedKeys->merge(collect([
            'form-control' => '',
        ]));
        $this->excludedKeys = $this->excludedKeys->merge(collect([
            'placeholder' => '',
        ]));
    }

    protected function renderBaseControl() : string
    {
        return app('form')->callParentMethod(
            $this->type,
            $this->value,
            $this->options
        );
    }

    public function getTypeAttribute() : string
    {
        return 'button';
    }
}
