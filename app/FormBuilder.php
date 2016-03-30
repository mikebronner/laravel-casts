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
        $options = $this->getClasses($name, $options, ['form-control']);
        $html = parent::select($name, $list, $selected, $options);

        return $this->render($html, $name, $options);
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
        $options = $this->getClasses($name, $options, ['form-control']);
        $options['multiple'] = '';

        return $this->select($name, $list, $selected, $options);
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
        $options = $this->getClasses($name, $options, ['form-control']);
        $html = parent::text($name, $value, $options);

        return $this->render($html, $name, $options);
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
        $options = $this->getClasses($name, $options, ['form-control']);
        $html = parent::password($name, $options);

        return $this->render($html, $name, $options);
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
        $options = $this->getClasses($name, $options, ['form-control']);
        $html = parent::email($name, $value, $options);

        return $this->render($html, $name, $options);
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
        $options = $this->getClasses($name, $options, ['form-control']);
        $html = parent::url($name, $value, $options);

        return $this->render($html, $name, $options);
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
        $options = $this->getClasses($name, $options, ['form-control']);
        $html = parent::file($name, $options);

        if ($this->framework === 'bootstrap-4') {
            $html = '<span class="file">' . $html . '<span class="file-custom"></span></span>';
        }

        return $this->render($html, $name, $options);
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
        $options = $this->getClasses($name, $options, ['form-control']);
        $html = parent::textarea($name, $value, $options);

        return $this->render($html, $name, $options);
    }

    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        $this->framework = config('genealabs-laravel-casts.front-end-framework');
        $options = $this->getClasses($name, $options);
        $label = $options['label'];
        unset($options['label']);
        $html = parent::checkbox($name, $value, $checked, $options);

        if ($this->framework === 'none') {
            return $html;
        }

        $html = '<div class="checkbox"><label>' . $html . ' ' . $label . '</label></div>';

        return $this->render($html, $name, $options);
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
        $options = $this->getClasses('', $options, ['btn', 'btn-primary']);

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
     * @param string $html
     * @param string $name
     * @param array  $options
     *
     * @return string
     */
    private function render($html, $name, array $options)
    {
        if ($this->framework === 'none') {
            return $html;
        }

        $output = $this->preHtml($name, $options);
        $output .= $html;
        $output .= $this->postHtml($name, $options);

        return $output;
    }

    /**
     * @param string $name
     * @param array  $options
     *
     * @return string
     */
    private function preHtml($name, array $options)
    {
        $label = array_get($options, 'label', '');
        $extraElement = array_get($options, 'extraElement', null);
        $extraWidth = array_get($options, 'extraWidth', 0);

        $hasExtras = (strlen(trim($extraElement)) && $extraWidth > 0);
		$fieldWidth = ($hasExtras ? $fieldWidth = $this->fieldWidth - $extraWidth : $this->fieldWidth);
        $formGroupClasses = [];
        $formGroupClasses[] = 'form-group';
        $formGroupClasses[] = ((count($this->errors) > 0)
            ? (($this->errors->has($name)) ? 'has-error' : 'has-success')
            : '');
        $labelClasses = [];
        $labelClasses[] = 'col-sm-' . $this->labelWidth;

        if (config('genealabs-laravel-casts.front-end-framework') === 'bootstrap-3') {
            $formGroupClasses[] = ((count($this->errors) > 0) ? 'has-feedback' : '');
            $labelClasses[] = 'control-label';
        }

        if (config('genealabs-laravel-casts.front-end-framework') === 'bootstrap-4') {
            if ($this->isHorizontalForm) {
                $formGroupClasses[] = 'row';
                $labelClasses[] = 'form-control-label';
            }
        }

        $html = '<div class="' . implode(' ', $formGroupClasses) . '">';
        $html .= $this->getLabelHtml($label, $name, $labelClasses);
        $html .= $this->getControlWrapperHtml($label, $fieldWidth);

        return $html;
    }

    /**
     * @param string $name
     * @param string $extraElement
     * @param int    $extraWidth
     *
     * @return string
     */
    protected function postHtml($name, array $options, $extraElement = null, $extraWidth = 0)
    {
        $html = '';
        $hasExtras = (strlen($extraElement) && $extraWidth > 0);

        if (count($this->errors)) {
            if ($this->framework === 'bootstrap-3') {
                $html .= '<span class="glyphicon ' . ($this->errors->has($name)
                        ? ' glyphicon-remove'
                        : ' glyphicon-ok') . ' form-control-feedback"></span>';
                $html .= $this->errors->all($name, '<p class="help-block">:message</p>');
            }

            if ($this->framework === 'bootstrap-4') {
                $html .= $this->errors->all($name, '<p><small class="text-help"></span></p>');
            }
        }

        if (array_key_exists('description', $options)) {
            $helpClass = ($this->framework === 'bootstrap-3' ? 'help-block' : '');
            $html .= '<small class="text-muted' . $helpClass . '">' . $options['description'] . '</small>';
        }

        if ($this->isHorizontalForm) {
            $html .= '</div>';
        }

        if ($hasExtras) {
            $html .= '<div class="col-sm-' . $extraWidth . '">' . $extraElement . '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    /**
     * @param string $name
     * @param array $options
     * @param array $addClassesIfNotExists
     *
     * @return array
     */
    private function getClasses($name, array $options, array $addClasses = [])
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
     * @param string $html
     * @param string $name
     * @param array  $labelClasses
     *
     * @return string
     */
    private function getLabelHtml($label, $name, $labelClasses)
    {
        if (! $label) {
            return '';
        }

        return $this->label($name, $label, ['class' => implode(' ', $labelClasses)]);
    }

    /**
    * @param string $label
    * @param int    $fieldWidth
     *
     * @return string
     */
    private function getControlWrapperHtml($label, $fieldWidth)
    {
        if (! $this->isHorizontalForm) {
            return '';
        }

        $offsetClass = $label ? '' : ' col-sm-offset-' . $this->labelWidth;

        return '<div class="col-sm-' . $fieldWidth . $offsetClass . '">';
    }
}
