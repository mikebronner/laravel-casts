<?php namespace GeneaLabs\LaravelCasts;

class StaticText extends Component
{
    public function __construct($value, array $options = [])
    {
        parent::__construct('', $value, $options);
    }

    protected function renderBaseControl() : string
    {
        return '<p class="form-control-static">' . $this->value . '</p>';
    }

    public function getTypeAttribute() : string
    {
        return 'staticText';
    }
}
