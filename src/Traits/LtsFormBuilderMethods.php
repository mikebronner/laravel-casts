<?php namespace GeneaLabs\LaravelCasts\Traits;

trait LtsFormBuilderMethods
{
    private function renderControlForLaravelLts(string $type, string $controlHtml, string $name, $value = '', array $options) : string
    {
        $labelHtml = $this->label($name, null, $options);

        return $this->group($name, $labelHtml, $controlHtml);
    }

    private function wrapFormControl(string $labelHtml, string $controlHtml, $errorHtml = '') : string
    {
        if (! $this->isHorizontalForm && $this->usesBootstrap3()) {
            return $controlHtml;
        }

        $offsetClass = $labelHtml ? '' : ' col-sm-offset-' . $this->labelWidth;

        return "<div class=\"col-sm-{$this->fieldWidth}{$offsetClass}\">{$controlHtml}{$errorHtml}</div>";
    }

    private function group(string $name, string $labelHtml, string $controlHtml) : string
    {
        $errorHtml = $this->getErrorHtml($name);
        $formGroupClasses = $this->getFormGroupClasses($name);
        $options = $this->setOptionClasses('', [], $formGroupClasses);
        $attributes = $this->html->attributes($options);
        $controlHtml = $this->wrapFormControl($labelHtml, $controlHtml, $errorHtml);

        return "<div {$attributes}>{$labelHtml}{$controlHtml}</div>";
    }

    private function getFormGroupClasses(string $name) : array
    {
        $formGroupClasses = [];
        $formGroupClasses[] = 'form-group';

        if (! $this->errors->isEmpty() && ! $this->errors->has($name)) {
            $formGroupClasses[] = 'has-success';
        }

        if ($this->errors->has($name) && $this->usesBootstrap3()) {
            $formGroupClasses[] = 'has-feedback';
            $formGroupClasses[] = 'has-error';
        }

        if ($this->errors->has($name) && $this->usesBootstrap4()) {
            $formGroupClasses[] = 'has-danger';
        }

        if ($this->usesBootstrap4() && $this->isHorizontalForm) {
            $formGroupClasses[] = 'row';
        }

        return $formGroupClasses;
    }

    private function getErrorHtml(string $name) : string
    {
        if (! $this->hasErrors()) {
            return '';
        }

        if (! $this->errors->has($name)) {
            return '';
        }

        $errors = implode(' ', $this->errors->get($name));

        if ($this->usesBootstrap3()) {
            return "<span class=\"help-block\">{$errors}</span>";
        }

        if ($this->usesBootstrap4()) {
            return "<small class=\"text-danger\"><em>{$errors}</em></small>";
        }

        return '';
    }

    private function hasErrors() : bool
    {
        return (count($this->errors) > 0);
    }

    private function setOptionClasses(string $name, array $options, array $addClasses = []) : array
    {
        $classes = [];

        if (array_key_exists('class', $options)) {
            $classes = explode(' ', $options['class']);
        }

        if (count($this->errors)) {
            if ($this->framework === 'bootstrap-4') {
                $classes[] = $this->errors->has($name) ? 'form-control-error' : 'form-control-success';
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

    private function usesBootstrap3()
    {
        return ($this->framework === 'bootstrap3');
    }

    private function usesBootstrap4()
    {
        return ($this->framework === 'bootstrap4');
    }

    private function setLabelOptionClasses(array $options)
    {
        $classes = explode(' ', array_get($options, 'class'));

        if ($this->isHorizontalForm) {
            $classes[] = 'col-sm-' . $this->labelWidth;
        }

        if ($this->usesBootstrap3()) {
            $classes[] = 'control-label';
        }

        if ($this->usesBootstrap4() && $this->isHorizontalForm) {
            $classes[] = 'form-control-label';
        }


        $classes = collect($classes)->filter(function ($value, $key) {
            $rejects = ['label', 'form-control', 'form-control-error', 'form-control-success', 'form-control-feedback'];

            return (! in_array($value, $rejects));
        });

        $classes = array_filter($classes->toArray());
        $options['class'] = implode(' ', $classes);

        return $options;
    }
}
