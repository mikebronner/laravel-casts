<?php namespace GeneaLabs\LaravelCasts\Traits;

trait LtsFormBuilderMethods
{
    private function renderControlForLaravelLts(string $type, string $controlHtml, string $name, $value = '', array $options) : string
    {
        if ($type !== 'checkbox' && $type !== 'submit') {
            $labelHtml = $this->label($name, null, $options);
        }

        if ($type === 'checkbox') {
            $openLabel = $this->usesBootstrap4()
                ? '<label class="form-check-label">'
                : '<label>';
            $closeLabel = '</label>';
            $controlHtml = $openLabel . $controlHtml . $closeLabel;
        }

        return $this->group($name, $labelHtml ?? '', $controlHtml);
    }

    private function wrapFormControl(string $labelHtml, string $controlHtml, $errorHtml = '') : string
    {
        if (! $this->isHorizontalForm && $this->usesBootstrap3()) {
            return $controlHtml;
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
            return "<small class=\"form-text text-danger\"><em>{$errors}</em></small>";
        }

        return '';
    }

    private function hasErrors() : bool
    {
        return (count($this->errors) > 0);
    }
}
