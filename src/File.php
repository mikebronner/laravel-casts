<?php namespace GeneaLabs\LaravelCasts;

class File extends ValuelessInput
{
    public function __construct(string $name, $value = null, array $options = [])
    {
        if (! array_key_exists("label", $options)
            || trim($options["label"]) === ""
        ) {
            $options["label"] = "Choose File";
        }

        parent::__construct($name, $value, $options);
    }
}
