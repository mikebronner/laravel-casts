<?php namespace GeneaLabs\LaravelCasts;

class EndButtonGroup extends Component
{
    public function __construct()
    {
        parent::__construct('');

        $this->classes = '';
    }

    public function getTypeAttribute() : string
    {
        return 'endButtonGroup';
    }

    protected function renderBaseControl() : string
    {
        return '';
    }
}
