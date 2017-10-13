<?php namespace GeneaLabs\LaravelCasts;

class CancelButton extends Button
{
    public function __construct(string $returnUrl)
    {
        parent::__construct('');

        $this->classes = 'btn btn-cancel pull-right';
        $this->returnUrl = $returnUrl;
    }

    public function getTypeAttribute() : string
    {
        return 'a';
    }

    protected function renderBaseControl() : string
    {
        return '<a href="' . ($this->returnUrl ?: url()->previous()) .
            '" class="' . $this->options['class'] . '">Cancel</a>';
    }

    public function getHtmlAttribute() : string
    {
        return $this->renderBaseControl();
    }
}
