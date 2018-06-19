<?php namespace GeneaLabs\LaravelCasts;

use Illuminate\Support\MessageBag;

class FormErrors extends Component
{
    protected $errorOptions;

    public function __construct($options = [])
    {
        parent::__construct("", null, $options);

        $this->errorOptions = $options;
    }

    public function renderBaseControl() : string
    {
        $controlHtml = "";
        $html = "";

        foreach (session("errors", new MessageBag())->all() as $error) {
            $controlHtml .= "<li>{$error}</li>";
        }

        if ($controlHtml) {
            $html = "<ul";

            foreach ($this->errorOptions as $attribute => $value) {
                $html .= " {$attribute}=\"{$value}\"";
            }

            $html .= ">{$controlHtml}</ul>";
        }

        return $html;
    }

    public function getHtmlAttribute() : string
    {
        return $this->renderBaseControl();
    }
}
