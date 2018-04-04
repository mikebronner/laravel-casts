<?php namespace GeneaLabs\LaravelCasts;

use Jenssegers\Model\Model;

abstract class Component extends Model
{
    protected $classes;
    protected $errors;
    protected $excludedKeys;
    protected $excludedClasses;
    protected $fieldWidth;
    protected $framework;
    protected $labelWidth;
    protected $name;
    protected $value;

    public function __construct(
        string $name,
        $value = null,
        array $options = []
    ) {
        $this->classes = 'form-control';
        $this->excludedKeys = collect([
            'label' => '',
            'offsetClass' => '',
        ]);
        $this->excludedClasses = collect();
        $this->framework = $options['framework']
            ?? app('form')->framework;
        $this->labelWidth = $options['labelWidth']
            ?? app('form')->labelWidth;
        $this->fieldWidth = $options['labelWidth']
            ?? app('form')->fieldWidth;
        $this->name = $name;
        $this->value = $value
            ?? app("form")->getModel()->$name;
        $options['id'] = $options['id'] ?? $name;
        $options['offsetClass'] = '';

        if ($this->framework === 'bootstrap3') {
            $options['offsetClass'] = trim($options['label'] ?? '') === ' '
                ? ' col-sm-offset-' . $this->labelWidth
                : '';
        }

        if ($this->framework === 'bootstrap4') {
            $options['offsetClass'] = trim($options['label'] ?? '') === ' '
                ? ' offset-sm-' . $this->labelWidth
                : '';
        }

        $this->attributes['options'] = $options;
        $this->errors = app('form')->errors ?: collect();
    }

    protected function renderBaseControl() : string
    {
        return app('form')->callParentMethod(
            $this->type,
            $this->name,
            $this->value,
            $this->options
        );
    }

    public function getHtmlAttribute() : string
    {
        $options = collect($this->attributes['options'])
            ->filter(function ($value) {
                return (bool) $value;
            })
            ->toArray();
        $controlHtml = $this->renderBaseControl();
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

    public function getTypeAttribute() : string
    {
        return str_replace('genealabslaravelcasts', '', str_slug(basename(get_called_class())));
    }

    public function getHasErrorAttribute() : bool
    {
        return $this->errors
            ->filter(function ($name) {
                return $this->name === $name;
            })
            ->isNotEmpty();
    }

    public function getErrorClassesAttribute() : string
    {
        return $this->errors
            ->isNotEmpty()
                ? ($this->framework === 'bootstrap3'
                    ? ($this->hasErrors
                        ? 'has-error'
                        : 'has-success'
                    )
                    : ($this->framework === 'bootstrap4'
                        ? ($this->hasErrors
                            ? 'form-control is-invalid'
                            : 'form-control is-valid'
                        )
                        : ''
                    )
                )
                : '';
    }

    public function getOptionsAttribute() : array
    {
        $classes = collect(explode(' ', $this->classes));
        $options = $this->attributes['options'];
        $classes = $classes->merge(collect(explode(' ', $options['class'] ?? '')));
        $classes = $classes->merge(collect(explode(' ', $this->errorClasses)))
            ->filter()
            ->unique()
            ->implode(' ');
        unset($options['class']);

        if ($classes) {
            $options['class'] = $classes;
        }

        $this->attributes['options'] = $options;

        return collect($this->attributes['options'])
            ->map(function ($value, $key) {
                if ($key !== 'class') {
                    return trim($value);
                }

                return collect(explode(' ', $value))
                    ->filter(function ($class) {
                        return ! $this->excludedClasses->has($class);
                    })
                    ->implode(' ');
            })
            ->filter(function ($value, $key) {
                return ! $this->excludedKeys->has($key);
            })
            ->filter()
            ->unique()
            ->toArray();
    }
}
