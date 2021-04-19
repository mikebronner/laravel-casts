<?php namespace GeneaLabs\LaravelCasts;

use Collective\Html\FormBuilder as Form;
use GeneaLabs\LaravelCasts\Subform;
use Illuminate\Support\MessageBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class FormBuilder extends Form
{
    public $offset = 0;
    public $isHorizontal = false;
    public $isInButtonGroup = false;
    public $isInline = false;
    public $errorData;
    public $framework = 'tailwind';
    public $labelWidth = 3;
    public $fieldWidth = 9;
    public $subFormClass = '';

    public function callParentMethod($method, $arg1 = null, $arg2 = null, $arg3 = null, $arg4 = null, $arg5 = null) : string
    {
        return parent::{$method}($arg1, $arg2, $arg3, $arg4, $arg5);
    }

    public function form()
    {
        if (func_num_args() > 1) {
            return call_user_func_array(array($this, 'model'), func_get_args());
        }

        return call_user_func_array(array($this, 'open'), func_get_args());
    }

    public function open(array $options = [])
    {
        $this->initializeForm($options);
        unset($options['framework']);

        return parent::open($options);
    }

    public function close()
    {
        $this->session->forget("customErrors");

        return parent::close();
    }

    public function model($model, array $options = [])
    {
        $this->initializeForm($options);
        unset($options['framework']);

        return parent::model($model, $options);
    }

    public function initializeForm(array $options = [])
    {
        $this->framework = $options['framework']
            ?? config('genealabs-laravel-casts.framework');
        $this->errors = $this->session->get('customErrors', $this->session->get('errors', new MessageBag));
        $this->isHorizontal = false;
        $this->isInline = false;
        $this->isHorizontal = (strpos($options['class'] ?? '', 'form-horizontal') !== false);
        $this->isInline = (strpos($options['class'] ?? '', 'form-inline') !== false);
        $this->offset = $options['offset'] ?? $this->offset;
        $this->labelWidth = $options['labelWidth'] ?? $this->labelWidth;
        $this->fieldWidth = $options['fieldWidth'] ?? $this->fieldWidth;
    }

    public function subform(array $options = []) : string
    {
        $this->initializeForm($options);
        $this->subFormClass = $options['subFormClass'] ?? '';

        return (new Subform($options))->html;
    }

    public function endsubform()
    {
        $this->session->forget("customErrors");
        $this->subFormClass = '';
    }

    public function token()
    {
        return $this->hidden('_token', csrf_token());
    }

    /**
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function label($name, $label = null, $options = [], $escapeHtml = true)
    {
        return (new Label($name, $label, $options, $escapeHtml))->html;
    }

    public function errors(string $intro = "", array $options = []) : string
    {
        return (new Errors($intro, $options))->html;
    }

    public function staticText(string $value, array $options = [])
    {
        return (new StaticText($value, $options))->html;
    }

    public function text($name, $value = null, $options = [])
    {
        return (new Text($name, $value, $options))->html;
    }

    public function tel($name, $value = null, $options = [])
    {
        return (new Tel($name, $value, $options))->html;
    }

    public function week($name, $value = null, $options = [])
    {
        return (new Week($name, $value, $options))->html;
    }

    public function month($name, $value = null, $options = [])
    {
        return (new Month($name, $value, $options))->html;
    }

    public function search($name, $value = null, $options = [])
    {
        return (new Search($name, $value, $options))->html;
    }

    public function number($name, $value = null, $options = [])
    {
        return (new Number($name, $value, $options))->html;
    }

    public function range($name, $value = null, $options = [])
    {
        return (new Range($name, $value, $options))->html;
    }

    public function color($name, $value = null, $options = [])
    {
        return (new Color($name, $value, $options))->html;
    }

    public function email($name, $value = null, $options = [])
    {
        return (new Email($name, $value, $options))->html;
    }

    public function password($name, $options = [])
    {
        return (new Password($name, null, $options))->html;
    }

    public function url($name, $value = null, $options = [])
    {
        return (new Url($name, $value, $options))->html;
    }

    public function file($name, $options = [])
    {
        return (new File($name, null, $options))->html;
    }

    public function textarea($name, $value = null, $options = [])
    {
        return (new Textarea($name, $value, $options))->html;
    }

    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        return (new Checkbox($name, $value, $checked, $options))->html;
    }

    public function radio($name, $value = 1, $checked = null, $options = [])
    {
        return (new Radio($name, $value, $checked, $options))->html;
    }

    public function switch($name, $value = 1, $checked = null, $options = [])
    {
        return (new Switchbutton($name, $value, $checked, $options))->html;
    }

    public function combobox(string $name, array $list = [], $selected = null, array $options = [], array $optionOptions = [])
    {
        if ($selected
            && array_key_exists("model", $options)
            && $options["model"]
        ) {
            $selected = (new $options["model"])->find($selected);
        }

        return (new Combobox($name, $list, $selected, $options, $optionOptions))->html;
    }

    public function select($name, $list = [], $selected = null,  array $selectAttributes = [], array $optionsAttributes = [], array $optgroupsAttributes = [])
    {
        return (new Select($name, $list, $selected, $selectAttributes, $optionsAttributes, $optgroupsAttributes))->html;
    }

    public function selectMonths($name, $value = null, array $options = [], array $optionOptions = [])
    {
        return (new SelectMonths($name, $value, $options, $optionOptions))->html;
    }

    public function selectWeekdays($name, $value = null, array $options = [], array $optionOptions = [])
    {
        return (new SelectWeekdays($name, $value, $options, $optionOptions))->html;
    }

    public function selectRange(
        $name,
        $begin,
        $end,
        $value = null,
        $options = []
    ) : string {
        return (new SelectRange($name, $begin, $end, $value, $options))->html;
    }

    public function selectRangeWithInterval(
        string $name,
        $begin,
        $end,
        $interval,
        int $value = null,
        array $options = [],
        array $optionOptions = []
    ) : string {
        return (new SelectRangeWithInterval($name, $begin, $end, $interval, $value, $options, $optionOptions))->html;
    }

    public function date($name, $value = null, $options = [])
    {
        return (new Date($name, $value, $options))->html;
    }

    public function datetime($name, $value = null, $options = [])
    {
        return (new Datetime($name, $value, $options))->html;
    }

    public function hidden($name, $value = null, $options = [])
    {
        return (new Hidden($name, $value, $options))->html;
    }

    public function signature($name, $value = null, $options = [])
    {
        return (new Signature($name, $value, $options))->html;
    }

    public function submit($value = null, $options = [])
    {
        return (new Submit($value, $options))->html;
    }

    public function cancelButton($returnUrl = '')
    {
        return (new CancelButton($returnUrl))->html;
    }

    public function button($value = null, $options = [])
    {
        return (new Button($value, $options))->html;
    }

    public function buttonGroup(array $options = [])
    {
        $this->isInButtonGroup = true;

        return (new ButtonGroup($options))->html;
    }

    public function endButtonGroup()
    {
        $this->isInButtonGroup = false;

        return (new EndButtonGroup)->html;
    }
}
