<?php namespace GeneaLabs\LaravelCasts;

class FormErrors extends Component
{
    public function renderBaseControl() : string
    {
        $controlHtml = '<ul>';

        foreach (app("form")->errors as $error) {
            $controlHtml .= "<li>{$error}</li>";
        }

        $controlHtml .= '</ul>';

        return $controlHtml;
    }

    public function getHtmlAttribute() : string
    {
        return $this->renderBaseControl();
    }
}
