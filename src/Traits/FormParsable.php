<?php namespace GeneaLabs\LaravelCasts\Traits;

use Illuminate\Support\Collection;

trait FormParsable
{
    private function renderControl(
        string $type,
        string $controlHtml,
        string $name,
        $value = '',
        array $options = []
    ) : string {
        $method = [
            $this,
            "{$this->framework}Control",
        ];
        $parameters = [
            $type,
            $controlHtml,
            $name,
            $value,
            $options,
            $this->fieldWidth,
            $this->labelWidth,
            $this->isHorizontal,
            $this->isInline,
            $this->isInButtonGroup,
            $this->errors ?? collect(),
        ];

        return call_user_func_array($method, $parameters);
    }

    protected function renderInput(string $type, string $name, $value = null, array $options = []) : string
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = $this->getControlOptions(collect($options))
            ->toArray();

        if (in_array($type, ['range', 'week', 'month'])) {
            $controlHtml = parent::input($type, $name, $value, $controlOptions);

            return $this->renderControl($type, $controlHtml, $name, $value, $options);
        }

        if (in_array($type, ['password', 'file'])) {
            $controlHtml = parent::{$type}($name, $controlOptions);

            return $this->renderControl($type, $controlHtml, $name, $value, $options);
        }

        $controlHtml = parent::{$type}($name, $value, $controlOptions);

        return $this->renderControl($type, $controlHtml, $name, $value, $options);
    }

    protected function setOptionClasses(string $name, array $options, array $addClasses = []) : array
    {
        $this->framework = $options['framework'] ?? $this->framework;
        $options = array_filter($options);
        $classes = [];

        if ($this->subFormClass) {
            $options['subFormClass'] = $this->subFormClass;
        }

        if (array_key_exists('class', $options)) {
            $classes = explode(' ', $options['class']);
        }

        if (count($this->errors)) {
            if ($this->framework === 'bootstrap3') {
                $classes[] = $this->errors->has($name) ? 'has-error' : 'has-success';
            }

            if ($this->framework === 'bootstrap4') {
                $classes[] = $this->errors->has($name) ? 'form-control is-invalid' : 'form-control is-valid';
            }
        }

        foreach ($addClasses as $key => $class) {
            if (! in_array($class, $classes)) {
                $classes[] = $class;
            }
        }

        if (array_key_exists('labelWidth', $options)) {
            $this->labelWidth = $options['labelWidth'];
        }

        if (array_key_exists('fieldWidth', $options)) {
            $this->fieldWidth = $options['fieldWidth'];
        }

        $classes = array_filter($classes);
        $options['class'] = implode(' ', $classes);

        return $options;
    }

    protected function usesBootstrap3()
    {
        return ($this->framework === 'bootstrap3');
    }

    protected function usesBootstrap4()
    {
        return ($this->framework === 'bootstrap4');
    }

    protected function setLabelOptionClasses(array $options)
    {
        $classes = explode(' ', array_get($options, 'class'));

        if ($this->isHorizontal) {
            $classes[] = 'col-sm-' . $this->labelWidth;
        }

        if ($this->usesBootstrap3()) {
            $classes[] = 'control-label';
        }

        if ($this->usesBootstrap4() && $this->isHorizontal) {
            $classes[] = 'col-form-label';
        }

        $classes = collect($classes)->filter(function ($value, $key = null) {
            $rejects = [
                'form-control',
                'form-control-error',
                'form-control-success',
                'form-control-feedback',
                'form-control-file',
                'form-check-input',
            ];

            return (! in_array($value, $rejects));
        });

        $classes = array_filter($classes->toArray());
        $options['class'] = implode(' ', $classes);
        $options = array_filter($options, function ($key) {
            $exclusions = collect([
                'label',
                'placeholder',
            ])->flip();

            return (! $exclusions->has($key));
        }, ARRAY_FILTER_USE_KEY);

        return $options;
    }

    protected function getControlOptions(Collection $options, array $additionalExclusions = []) : Collection
    {
        $additionalExclusions = collect($additionalExclusions)->flip();

        $options = $options->map(function ($value, $key) use ($additionalExclusions) {
            $excludedKeys = collect([
                'label' => '',
            ]);
            $excludedKeys = $excludedKeys->merge($additionalExclusions);

            return ($excludedKeys->has($key) ? null : $value);
        });

        return $options->filter(function ($value) {
            return ($value !== null);
        });
    }
}
