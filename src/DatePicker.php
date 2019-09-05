<?php namespace GeneaLabs\LaravelCasts;

use Illuminate\Support\Str;

abstract class DatePicker extends Component
{
    public function __construct(
        string $name,
        $value = null,
        array $options = []
    ) {
        $random = Str::random(12);
        $options['autocomplete'] = 'noway';
        $options['data-target'] = "datetimepicker-{$name}-{$random}";

        parent::__construct($name, $value, $options);

        $this->classes = 'form-control datetimepicker-input';
    }

    public function getHtmlAttribute() : string
    {
        $controlHtml = $this->renderBaseControl();

        $options = $this->attributes['options'];
        $options['value'] = $this->value;

        $method = [
            app('form'),
            "{$this->framework}Control",
        ];
        $parameters = [
            $this->type,
            $controlHtml,
            $this->name,
            $this->value,
            $options,
            $this->fieldWidth,
            $this->labelWidth,
            app('form')->isHorizontal,
            app('form')->isInline,
            app('form')->isInButtonGroup,
            $this->errors,
        ];

        return call_user_func_array($method, $parameters);
    }
    
    
    protected function renderBaseControl() : string
    {
        return app('form')->callParentMethod(
            "text",
            $this->name,
            $this->value,
            $this->options
        );
    }
}
