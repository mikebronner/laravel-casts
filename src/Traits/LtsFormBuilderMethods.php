<?php namespace GeneaLabs\LaravelCasts\Traits;

trait LtsFormBuilderMethods
{
    private function renderControlForLaravelLts(string $type, string $controlHtml, string $name, $value = '', array $options) : string
    {
        if ($type !== 'checkbox' && $type !== 'radio' && $type !== 'submit') {
            $labelHtml = $this->label($name, null, $options);
        }

        if ($type === 'checkbox') {
            $openLabel = '';
            $closeLabel = '';

            if ($this->usesBootstrap4()) {
                $openLabel = '<label class="form-check-label">';
                $closeLabel = '</label>';
            }

            if ($this->usesBootstrap3()) {
                $openLabel = '<div class="checkbox"><label>';
                $closeLabel = '</label></div>';
            }

            $controlHtml = $openLabel . $controlHtml . $closeLabel;
        }

        if ($type === 'radio') {
            $openLabel = '';
            $closeLabel = '';

            if ($this->usesBootstrap4()) {
                $openLabel = '<label class="form-check-label">';
                $closeLabel = '</label>';
            }

            if ($this->usesBootstrap3()) {
                $openLabel = '<div class="radio"><label>';
                $closeLabel = '</label></div>';
            }

            $controlHtml = $openLabel . $controlHtml . $closeLabel;
        }

        return $this->group($name, $labelHtml ?? '', $controlHtml);
    }

    private function wrapFormControl(string $labelHtml, string $controlHtml, $errorHtml = '') : string
    {
        if (! $this->isHorizontal) {
            return $controlHtml . $errorHtml;
        }

        $offsetClass = $labelHtml ? '' : ' col-sm-offset-' . $this->labelWidth;

        if ($this->usesBootstrap4()) {
            $offsetClass = $labelHtml ? '' : ' offset-sm-' . $this->labelWidth;
        }

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

        if ($this->usesBootstrap4() && $this->isHorizontal) {
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
            return "<small class=\"form-text text-danger\"><em>{$errors}</em></small>";
        }

        return '';
    }

    private function hasErrors() : bool
    {
        return (count($this->errors) > 0);
    }
}
