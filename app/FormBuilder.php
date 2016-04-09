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

        return $this->group($labelHtml, $controlHtml);
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
            $label = array_get($options, 'label', '');
        }

        if (! $label) {
            return '';
        }

        $labelClasses = [];
        $labelClasses[] = ($this->isHorizontalForm
            ? 'col-sm-' . $this->labelWidth
            : null);
        $labelClasses[] = ($this->usesBootstrap3()
            ? 'control-label'
            : null);
        $labelClasses[] = ($this->usesBootstrap4() && $this->isHorizontalForm
            ? 'form-control-label'
            : null);

        $options = $this->setOptionClasses('', $options, $labelClasses);

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
        $labelHtml = $this->label($name, array_pull($options, 'label'));
        $controlHtml = parent::text($name, $value, $options);

        return $this->group($labelHtml, $controlHtml);
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

        return $this->group($labelHtml, $controlHtml);
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
        $labelHtml = $this->label($name, array_pull($options, 'label'));
        $controlHtml = parent::password($name, $options);

        return $this->group($labelHtml, $controlHtml);
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
        $labelHtml = $this->label($name, array_pull($options, 'label'));
        $controlHtml = parent::url($name, $value, $options);

        return $this->group($labelHtml, $controlHtml);
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
        $labelHtml = $this->label($name, array_pull($options, 'label'));
        $controlHtml = parent::file($name, $options);

        if ($this->$usesBootstrap4) {
            $controlHtml = '<span class="file">' . $controlHtml . '<span class="file-custom"></span></span>';
        }

        return $this->group($labelHtml, $controlHtml);
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
        $labelHtml = $this->label($name, array_pull($options, 'label'));
        $controlHtml = parent::textarea($name, $value, $options);

        return $this->group($labelHtml, $controlHtml);
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

        return $this->group(null, $html);
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

        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->setOptionClasses('', $options, ['btn', 'btn-primary']);

        $html = $this->preHtml('', []);

        if (! is_null($cancelUrl)) {
            $html = '<div class="form-group"><div class="col-sm-' . $this->labelWidth . '">'
				. link_to($cancelUrl, 'Cancel', ['class' => 'btn btn-cancel pull-right'])
                . '</div><div class="col-sm-' . $this->fieldWidth . '">';
		}

        $html .= parent::submit($value, $options);
        $html .= '</div></div>';

        return $html;
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

        $options['class'] = implode(' ', $classes);

        return $options;
    }

    /**
    * @param string $label
    * @param int    $fieldWidth
     *
     * @return string
     */
    private function wrapFormControl($labelHtml, $controlHtml)
    {
        if (! $this->isHorizontalForm) {
            return '';
        }

        $offsetClass = $labelHtml ? '' : ' col-sm-offset-' . $this->labelWidth;

        return "<div class=\"col-sm-{$this->fieldWidth}{$offsetClass}\">{$controlHtml}</div>";
    }

    private function group($labelHtml, $controlHtml)
    {
        $formGroupClasses = [];
        $formGroupClasses[] = 'form-group';
        $formGroupClasses[] = ($this->hasErrors()
            ? ($this->errors->has($name) ? 'has-error' : 'has-success')
            : null);
        $formGroupClasses[] = ($this->usesBootstrap3() && $this->hasErrors()
            ? 'has-feedback'
            : null);
        $formGroupClasses[] = ($this->usesBootstrap4() && $this->isHorizontalForm
            ? 'row'
            : null);

        $options = $this->setOptionClasses('', [], $formGroupClasses);
        $attributes = $this->html->attributes($options);
        $controlHtml = $this->wrapFormControl($labelHtml, $controlHtml);

        return "<div {$attributes}>{$labelHtml}{$controlHtml}</div>";
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
