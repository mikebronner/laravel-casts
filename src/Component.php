<?php namespace GeneaLabs\LaravelCasts;

use Jenssegers\Model\Model;
use Illuminate\Support\Collection;
use Collective\Html\FormBuilder;

abstract class Component extends Model
{
    protected $classes;
    protected $errors;
    protected $excludedKeys;
    protected $excludedClasses;
    protected $framework;
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
        ]);
        $this->excludedClasses = collect();
        $this->framework = $options['framework'] ?? app('form')->framework;
        $this->name = $name;
        $this->value = $value;
        $this->attributes['options'] = $options;
        $this->labelWidth = $options['labelWidth'] ?? app('form')->labelWidth;
        $this->fieldWidth = $options['labelWidth'] ?? app('form')->fieldWidth;
        $this->errors = app('form')->errors;
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
            $this->attributes['options'],
            $this->fieldWidth,
            $this->labelWidth,
            $this->isHorizontal,
            $this->isInline,
            app('form')->isInButtonGroup,
            $this->errors ?? collect(),
        ];

        return call_user_func_array($method, $parameters);
    }

    public function getTypeAttribute() : string
    {
        return str_replace('genealabslaravelcasts', '', str_slug(basename(get_called_class())));
    }

    public function getHasErrorAttribute() : boolean
    {
        return $this->errors
            ->filter(function ($name) {
                return $this->name === $name;
            })
            ->isNotEmpty();
    }

    public function getErrorClasses() : string
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
        $options['subFormClass'] = $this->subFormClass;
        $classes = $classes->merge(collect(explode(' ', $options['class'] ?? '')));
        $classes = $classes->merge(collect(explode(' ', $this->errorClasses)));
        $options['class'] = $classes->filter()
            ->unique()
            ->implode(' ');
        $this->attributes['options'] = $options;

        return collect($this->attributes['options'])
            ->map(function ($value, $key) {
                if ($key !== 'class') {
                    return trim($value);
                }

                return collect(explode(' ', $value))
                    ->filter(function ($class) {
                        return ($this->excludedClasses->has($class) ? null : $class);
                    })
                    ->implode(' ');
            })
            ->filter(function ($value, $key) {
                return ($this->excludedKeys->has($key) ? null : $value);
            })
            ->unique()
            ->toArray();
    }
}
