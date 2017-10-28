<?php namespace GeneaLabs\LaravelCasts;

class File extends ValuelessInput
{
    public function __construct(string $name, $value = null, array $options = [])
    {
        parent::__construct($name, $value, $options);

        if ($this->framework === 'bootstrap3') {
            $this->classes = 'form-control form-control-file';
        }

        if ($this->framework === 'bootstrap4') {
            $this->classes = 'custom-file-input';
        }
    }
}
