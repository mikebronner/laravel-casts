<?php namespace GeneaLabs\LaravelCasts;

abstract class Input extends Component
{
    public function __construct(
        string $name,
        $value = null,
        array $options = []
    ) {
        parent::__construct($name, $value, $options);

        if ($this->framework === 'tailwind') {
            $this->classes .= ' form-input w-full';
        }
    }
}
