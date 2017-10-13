<?php namespace GeneaLabs\LaravelCasts;

class Signature extends Component
{
    public function __construct(string $name, $value = null, array $options = [])
    {
        if (! array_key_exists('label', $options)) {
            $options['label'] = ucwords(str_replace('_id', '', str_replace('[]', '', $name)));
        }

        if (! array_key_exists('clearButton', $options)) {
            $options['clearButton'] = 'Clear';
        }

        parent::__construct($name, $value, $options);

        $this->classes = '';
    }

    protected function renderBaseControl() : string
    {
        $html = (new Hidden($this->name, ''))->html;
        $html .= (new Hidden($this->name . '_date', ''))->html;

        return $html;
    }
}
