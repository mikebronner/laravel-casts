<?php namespace GeneaLabs\LaravelCasts;

class Submit extends Button
{
    public function __construct(string $value, array $options = [])
    {
        $options['type'] = 'submit';

        parent::__construct($value, $options);

        $this->classes = 'btn btn-primary';
        $this->excludedClasses = collect([
            'form-control-success',
            'form-control-warning',
            'form-control-danger',
        ]);
    }

    protected function renderBaseControl() : string
    {
        return app('form')->callParentMethod(
            $this->type,
            $this->value,
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
            $this->type,
            $controlHtml,
            '',
            '',
            $this->attributes['options'],
            app('form')->fieldWidth,
            app('form')->labelWidth,
            app('form')->isHorizontal,
            app('form')->isInline,
            app('form')->isInButtonGroup,
            app('form')->errors ?? collect(),
        ];

        return call_user_func_array($method, $parameters);
    }
}
