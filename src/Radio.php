<?php namespace GeneaLabs\LaravelCasts;

class Radio extends Toggle
{
    public function __construct(
        string $name,
        $value = null,
        bool $isChecked = null,
        array $options = []
    ) {
        parent::__construct($name, $value, $isChecked, $options);

        if ($this->framework === 'tailwind') {
            $this->classes = 'form-radio';
        }
    }
}
