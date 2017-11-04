<?php namespace GeneaLabs\LaravelCasts;

class Hidden extends Input
{
    public function __construct(string $name, $value = null, array $options = [])
    {
        $value = $value ?: null;

        parent::__construct($name, $value, $options);

        $this->excludedKeys = $this->excludedKeys->merge(collect([
            'class' => '',
        ]));
    }

    public function getHtmlAttribute() : string
    {
        return $this->renderBaseControl();
    }
}
