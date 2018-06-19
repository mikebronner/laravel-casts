<?php namespace GeneaLabs\LaravelCasts;

use Illuminate\Support\MessageBag;

class Errors extends Component
{
    protected $errorOptions;
    protected $intro;

    public function __construct(string $intro = "", array $options = [])
    {
        parent::__construct("", null, $options);

        $this->errorOptions = $options;
        $this->intro = $intro;
    }

    public function renderBaseControl() : string
    {
        $controlHtml = "";
        $html = "";

        foreach (session("errors", new MessageBag())->all() as $error) {
            $controlHtml .= "<li>{$error}</li>";
        }

        if ($controlHtml) {
            $html = "<div";

            foreach ($this->errorOptions as $attribute => $value) {
                $html .= " {$attribute}=\"{$value}\"";
            }

            $html .= ">{$this->intro}<ul>{$controlHtml}</ul></div>";
        }

        return $html;
    }

    public function getHtmlAttribute() : string
    {
        return $this->renderBaseControl();
    }
}
