<?php namespace GeneaLabs\LaravelCasts;

class Switchbutton extends Toggle
{
    public function getTypeAttribute() : string
    {
        return 'checkbox';
    }

    protected function renderBaseControl() : string
    {
        return app('form')->callParentMethod(
            $this->type,
            $this->name,
            $this->value,
            $this->isChecked,
            $this->options
        );
    }

    public function getHtmlAttribute() : string
    {
        $controlHtml = $this->renderBaseControl();
        $method = [
            app('form'),
            "{$this->framework}Control",
        ];
        $parameters = [
            'switch',
            $controlHtml,
            $this->name,
            $this->value,
            $this->attributes['options'],
            $this->fieldWidth,
            $this->labelWidth,
            app('form')->isHorizontal,
            app('form')->isInline,
            app('form')->isInButtonGroup,
            $this->errorData,
        ];

        return call_user_func_array($method, $parameters);
    }
}
