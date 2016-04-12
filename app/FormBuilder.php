<?php namespace GeneaLabs\LaravelCasts;

use Collective\Html\FormBuilder as Form;
use Illuminate\Support\HtmlString;
use Illuminate\Support\MessageBag;

class FormBuilder extends Form
{
    protected $errors;
    protected $offset = 0;
    protected $labelWidth = 3;
    protected $fieldWidth = 9;
    protected $isHorizontalForm = false;
    protected $framework = 'none';

    /**
     * @param string $returnUrl
     *
     * @return string
     */
    public function cancelButton($returnUrl = '')
	{
		return '<a href="' .
            $this->url->previous() . '">' .
            $this->button('Cancel', ['class' => 'btn btn-cancel   pull-right']) .
            '</a>';
	}

    /**
     * @param string $name
     * @param int    $start
     * @param int    $end
     * @param int    $interval
     * @param int    $value
     * @param array  $options
     *
     * @return string
     */
    public function selectRangeWithInterval($name, $start, $end, $interval, $value = null, $options = [])
	{
        if ($interval == 0) {
            return parent::selectRange($name, $start, $end, $value, $options);
        }

		$items = [];
		$items[$value] = $value;
		$startValue = $start;
        $endValue = $end;
        $interval *= ($interval < 0) ? -1 : 1;

		if ($start > $end) {
			$interval *= ($interval > 0) ? -1 : 1;
			$startValue = $end;
            $endValue = $start;
        }

		for ($i=$startValue; $i<$endValue; $i+=$interval) {
            $items[$i . ""] = $i;
        }

        $items[$endValue] = $endValue;

        return $this->select($name, $items, $value, $options);
    }

    /**
     * @param string $name
     * @param array $list
     * @param string $selected
     * @param array $options
     *
     * @return string
     */
    public function select($name, $list = [], $selected = null, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $labelHtml = $this->label($name, array_pull($options, 'label'));
        $controlHtml = parent::select($name, $list, $selected, $options);

        return $this->group($name, $labelHtml, $controlHtml);
    }

    /**
     * @param array $options
     *
     * @return HtmlString
     */
    public function open(array $options = [])
    {
        $this->errors = app('session')->get('errors', new MessageBag());

        if (array_key_exists('class', $options) && (strpos($options['class'], 'form-horizontal') !== false)) {
            $this->isHorizontalForm = true;
        }

        if (array_key_exists('offset', $options)) {
            $this->offset = $options['offset'];
        }

        if (array_key_exists('labelWidth', $options)) {
            $this->labelWidth = $options['labelWidth'];
        }

        if (array_key_exists('fieldWidth', $options)) {
            $this->fieldWidth = $options['fieldWidth'];
        }

        return parent::open($options);
    }

    /**
     * @param  mixed $model
     * @param  array $options
     *
     * @return string
     */
    public function model($model, array $options = [])
    {
        $this->errors = app('session')->get('errors', new MessageBag());

        if (array_key_exists('class', $options) && (strpos($options['class'], 'form-horizontal') !== false)) {
            $this->isHorizontalForm = true;
        }

        if (array_key_exists('offset', $options)) {
            $this->offset = $options['offset'];
        }

        if (array_key_exists('labelWidth', $options)) {
            $this->labelWidth = $options['labelWidth'];
        }

        if (array_key_exists('fieldWidth', $options)) {
            $this->fieldWidth = $options['fieldWidth'];
        }

        return parent::model($model, $options);
    }


    public function label($name, $label = null, $options = [])
    {
        if (! $label) {
            $label = array_pull($options, 'label');
        }

        if (! $label) {
            return '';
        }

        $options = collect($options)->filter(function ($value, $key) {
            $rejects = ['label', 'form-control', 'form-control-error', 'form-control-success', 'form-control-feedback'];

            return ((strtolower($key) === 'class') && ! in_array($value, $rejects));
        });

        $labelClasses = collect(explode(' ', array_get($options, 'class')));

        if ($this->isHorizontalForm) {
            $labelClasses[] = 'col-sm-' . $this->labelWidth;
        }

        if ($this->usesBootstrap3()) {
            $labelClasses[] = 'control-label';
        }

        if ($this->usesBootstrap4() && $this->isHorizontalForm) {
            $labelClasses[] = 'form-control-label';
        }

        $options = $this->setOptionClasses('', $options->toArray(), $labelClasses->toArray());

        return parent::label($name, $label, $options);
    }

    /**
     * @param string $name
     * @param string $value
     * @param array $options
     *
     * @return string
     */
    public function text($name, $value = null, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses($name, $options, ['form-control']);

        $labelHtml = $this->label($name, null, $options);
        $controlHtml = parent::text($name, $value, $options);

        return $this->group($name, $labelHtml, $controlHtml);
    }

    /**
     * @param string $name
     * @param string $value
     * @param array $options
     *
     * @return string
     */
    public function email($name, $value = null, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $labelHtml = $this->label($name, array_pull($options, 'label'));
        $controlHtml = parent::email($name, $value, $options);

        return $this->group($name, $labelHtml, $controlHtml);
    }

    /**
     * @param string $name
     * @param array  $list
     * @param string $selected
     * @param array  $option
     *
     * @return string
     */
    public function combobox($name, $list = [], $selected = null, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $options['multiple'] = '';

        return $this->select($name, $list, $selected, $options);
    }

    /**
     * @param string $name
     * @param array $options
     *
     * @return string
     */
    public function password($name, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $labelHtml = $this->label($name, null, $options);
        $controlHtml = parent::password($name, $options);

        return $this->group($name, $labelHtml, $controlHtml);
    }

    /**
     * @param string $name
     * @param string $value
     * @param array $options
     *
     * @return string
     */
    public function url($name, $value = null, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $labelHtml = $this->label($name, null, $options);
        $controlHtml = parent::url($name, $value, $options);

        return $this->group($name, $labelHtml, $controlHtml);
    }

    /**
     * @param string $name
     * @param array $options
     *
     * @return string
     */
    public function file($name, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $labelHtml = $this->label($name, null, $options);
        $controlHtml = parent::file($name, $options);

        if ($this->$usesBootstrap4) {
            $controlHtml = '<span class="file">' . $controlHtml . '<span class="file-custom"></span></span>';
        }

        return $this->group($name, $labelHtml, $controlHtml);
    }

    /**
     * @param string $name
     * @param string $value
     * @param array $options
     *
     * @return string
     */
    public function textarea($name, $value = null, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $labelHtml = $this->label($name, null, $options);
        $controlHtml = parent::textarea($name, $value, $options);

        return $this->group($name, $labelHtml, $controlHtml);
    }

    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses($name, $options);
        $label = $options['label'];
        unset($options['label']);
        $html = parent::checkbox($name, $value, $checked, $options);

        if ($this->framework === 'none') {
            return $html;
        }

        $html = '<div class="checkbox"><label>' . $html . ' ' . $label . '</label></div>';

        return $this->group($name, null, $html);
    }

    /**
     * @param  string $value
     * @param  array  $options
     *
     * @return string
     */
    public function submit($value = null, $options = [])
    {
        $cancelUrl = array_key_exists('cancelUrl', $options) ? $options['cancelUrl'] : null;
        $cancelHtml = '';
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses('', $options, ['btn', 'btn-primary']);
        $controlHtml = parent::submit($value, $options);

        if (! is_null($cancelUrl)) {
            $cancelHtml = link_to($cancelUrl, 'Cancel', ['class' => 'btn btn-cancel pull-right']);
		}

        return $this->group(null, $cancelHtml, $controlHtml);
    }

    /**
     * @param string $name
     * @param array $options
     * @param array $addClassesIfNotExists
     *
     * @return array
     */
    private function setOptionClasses($name, array $options, array $addClasses = [])
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

        $classes = array_filter($classes);
        $options['class'] = implode(' ', $classes);

        return $options;
    }

    /**
    * @param string $label
    * @param int    $fieldWidth
     *
     * @return string
     */
    private function wrapFormControl($labelHtml, $controlHtml, $errorHtml = '')
    {
        if (! $this->isHorizontalForm) {
            return '';
        }

        $offsetClass = $labelHtml ? '' : ' col-sm-offset-' . $this->labelWidth;

        return "<div class=\"col-sm-{$this->fieldWidth}{$offsetClass}\">{$controlHtml}{$errorHtml}</div>";
    }

    private function group($name, $labelHtml, $controlHtml)
    {
        $errorHtml = $this->getErrorHtml($name);
        $formGroupClasses = $this->getFormGroupClasses($name);
        $options = $this->setOptionClasses('', [], $formGroupClasses);
        $attributes = $this->html->attributes($options);
        $controlHtml = $this->wrapFormControl($labelHtml, $controlHtml, $errorHtml);

        return "<div {$attributes}>{$labelHtml}{$controlHtml}</div>";
    }

    private function getFormGroupClasses($name)
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

    private function getErrorHtml($name) {
        if (! $this->hasErrors() xor ! $this->errors->has($name)) {
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

    private function hasErrors()
    {
        return (count($this->errors) > 0);
    }

    private function usesBootstrap3()
    {
        return ($this->framework === 'bootstrap-3');
    }

    private function usesBootstrap4()
    {
        return ($this->framework === 'bootstrap-4');
    }
}
