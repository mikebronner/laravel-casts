<?php namespace GeneaLabs\LaravelCasts;

use Collective\Html\FormBuilder as Form;
use GeneaLabs\LaravelCasts\Traits\FormParsable;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Collection;
use Carbon\Carbon;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class FormBuilder extends Form
{
    use FormParsable;

    protected $errors;
    protected $offset = 0;
    protected $labelWidth = 3;
    protected $fieldWidth = 9;
    protected $isHorizontal = false;
    protected $isInButtonGroup = false;
    protected $isInline = false;
    protected $framework = 'bootstrap3';
    protected $subFormClass = '';

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

        return parent::open($options);
    }

    public function model($model, array $options = [])
    {
        $this->initializeForm($options);

        return parent::model($model, $options);
    }

    public function initializeForm(array $options)
    {
        $this->framework = $options['framework'] ?? config('genealabs-laravel-casts.framework');
        $this->errors = $this->session->get('errors', new MessageBag());
        $this->isHorizontal = false;
        $this->isInline = false;

        if (array_key_exists('class', $options) && (strpos($options['class'], 'form-horizontal') !== false)) {
            $this->isHorizontal = true;
        }

        if (array_key_exists('class', $options) && (strpos($options['class'], 'form-inline') !== false)) {
            $this->isInline = true;
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
    }

    public function subForm(array $options = []) : string
    {
        $this->subFormClass = $options['subFormClass'];

        return $this->renderControl('subForm', '', '', null, $options);
    }

    public function endSubForm()
    {
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
        $this->framework = $options['framework'] ?? $this->framework;
        $label = array_pull($options, 'label') ?? $label ?? '';
        $options = $this->setLabelOptionClasses($options);
        $name = str_replace('_id', '', $name);
        $name = str_replace('[]', '', $name);
        $excludeOptions = [
            'list' => '',
            'subFormAction' => '',
            'subFormBlade' => '',
            'subFormClass' => '',
            'subFormFieldName' => '',
            'subFormMethod' => '',
            'subFormTitle' => '',
            'subFormResponseObjectPrimaryKey' => '',
        ];
        $options = collect($options)->diffKeys($excludeOptions)
            ->map(function ($option) {
                if (is_array($option)) {
                    return '';
                }

                $option = str_replace('btn-primary', '', $option);
                $option = str_replace('btn-default', '', $option);
                $option = str_replace('btn-danger', '', $option);
                $option = str_replace('btn-warning', '', $option);
                $option = str_replace('btn-success', '', $option);
                $option = str_replace('btn-secondary', '', $option);
                $option = str_replace('btn', '', $option);
                $option = str_replace('form-control-success', '', $option);
                $option = str_replace('form-control-warning', '', $option);
                $option = str_replace('form-control-danger', '', $option);

                return $option;
            })
            ->filter()
            ->toArray();

        return parent::label($name, $label, $options, $escapeHtml);
    }

    public function staticText(string $value, array $options = [])
    {
        $this->framework = $options['framework'] ?? $this->framework;
        $label = $options['label'] ?? '';
        $controlHtml = $this->toHtmlString('<p class="form-control-static">' . $value . '</p>');

        return $this->renderControl('staticText', $controlHtml, '', $label, []);
    }

    public function text($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::text($name, $value, $controlOptions);

        return $this->renderControl('text', $controlHtml, $name, $value, $options);
    }

    public function tel($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::tel($name, $value, $controlOptions);

        return $this->renderControl('tel', $controlHtml, $name, $value, $options);
    }

    public function week($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::input('week', $name, $value, $controlOptions);

        return $this->renderControl('week', $controlHtml, $name, $value, $options);
    }

    public function month($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::input('month', $name, $value, $controlOptions);

        return $this->renderControl('month', $controlHtml, $name, $value, $options);
    }

    public function search($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::search($name, $value, $controlOptions);

        return $this->renderControl('search', $controlHtml, $name, $value, $options);
    }

    public function number($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::number($name, $value, $controlOptions);

        return $this->renderControl('number', $controlHtml, $name, $value, $options);
    }

    public function email($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = $this->getControlOptions(collect($options));
        $controlHtml = parent::email($name, $value, $controlOptions->toArray());

        return $this->renderControl('email', $controlHtml, $name, $value, $options);
    }

    public function password($name, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = $this->getControlOptions(collect($options));
        $controlHtml = parent::password($name, $controlOptions->toArray());

        return $this->renderControl('password', $controlHtml, $name, '', $options);
    }

    public function url($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = $this->getControlOptions(collect($options));
        $controlHtml = parent::url($name, $value, $controlOptions->toArray());

        return $this->renderControl('url', $controlHtml, $name, $value, $options);
    }

    public function file($name, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control form-control-file']);
        $controlOptions = $this->getControlOptions(collect($options), ['placeholder']);

        if ($this->framework === 'bootstrap4') {
            $controlOptions = $controlOptions->map(function ($option, $index) {
                if ($index === 'class') {
                    $option = 'custom-file-input';
                }

                return $option;
            });
        }

        $controlHtml = parent::file($name, $controlOptions->toArray());

        return $this->renderControl('file', $controlHtml, $name, '', $options);
    }

    public function textarea($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = $this->getControlOptions(collect($options));
        $controlHtml = parent::textarea($name, $value, $controlOptions->toArray());

        return $this->renderControl('textarea', $controlHtml, $name, $value, $options);
    }

    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        $additionalClasses = $this->usesBootstrap4() ? 'form-check-input' : '';
        $options = $this->setOptionClasses($name, $options, [$additionalClasses]);
        $label = $options['label'] ?? ucwords($name);
        $controlOptions = $this->getControlOptions(collect($options), ['form-control', 'placeholder']);
        $controlHtml = parent::checkbox($name, $value, $checked, $controlOptions->toArray()) . " {$label}";

        return $this->renderControl('checkbox', $controlHtml, $name, $value, $options);
    }

    public function radio($name, $value = 1, $checked = null, $options = [])
    {
        $additionalClasses = $this->usesBootstrap4() ? 'form-check-input' : '';
        $options = $this->setOptionClasses($name, $options, [$additionalClasses]);
        $label = $options['label'];
        $controlOptions = $this->getControlOptions(collect($options), ['form-control', 'placeholder']);
        $controlHtml = parent::radio($name, $value, $checked, $controlOptions->toArray()) . " {$label}";

        return $this->renderControl('radio', $controlHtml, $name, $value, $options);
    }

    public function switch($name, $value = 1, $checked = null, $options = [])
    {
        $additionalClasses = $this->usesBootstrap4() ? 'form-check-input' : '';
        $options = $this->setOptionClasses($name, $options, [$additionalClasses]);
        $label = '';
        $controlOptions = $this->getControlOptions(collect($options), ['form-control', 'placeholder']);
        $controlHtml = parent::checkbox($name, $value, $checked, $controlOptions->toArray()) . " {$label}";

        return $this->renderControl('switch', $controlHtml, $name, $value, $options);
    }

    public function combobox(string $name, array $list = [], $selected = null, array $options = [], array $optionOptions = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $options['multiple'] = array_key_exists('multiple', $options) ? 'multiple' : null;

        if (array_key_exists('subFormAction', $options)) {
            $options['subFormMethod'] = $options['subFormMethod'] ?? 'POST';
            $options['subFormClass'] = '.' . str_random(6);
            $options['subFormResponseObjectPrimaryKey'] = $options['subFormResponseObjectPrimaryKey'] ?? 'id';
        }

        $options['list'] = collect($list)->transform(function ($item, $index) {
            return [
                'text' => $item,
                'value' => $index,
            ];
        })->values()->toJson();
        $options['selected'] = collect($selected)->transform(function ($item, $index) {
            return [
                'text' => $item,
                'value' => $index,
            ];
        })->values()->toJson();
        array_filter($options);
        $controlOptions = $this->getControlOptions(collect($options), ['list', 'selected']);
        $controlHtml = parent::select($name, $list, $selected, $controlOptions->toArray(), $optionOptions);
        $renderedHtml = $this->renderControl('combobox', $controlHtml, $name, null, $options);

        if (array_key_exists('subFormAction', $options)) {
            $renderedHtml .= $this->subform($options);
        }

        return $renderedHtml;
    }

    public function select($name, $list = [], $selected = null, array $options = [], array $optionOptions = [])
    {
        $this->framework = $options['framework'] ?? $this->framework;
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = collect($options);

        if ($this->framework === 'bootstrap4' && ! $controlOptions->has('multiple')) {
            $controlOptions = $controlOptions->map(function ($option, $index) {
                if ($index === 'class') {
                    $option .= ' custom-select';
                }

                return $option;
            });
        }

        $controlHtml = parent::select($name, $list, $selected, $controlOptions->toArray(), $optionOptions);

        if (array_key_exists('placeholder', $options)) {
            $controlHtml = str_replace('<option selected="selected" value="">' . $options['placeholder'] . '</option>', '<option selected="selected" value="" disabled="disabled">' . $options['placeholder'] . '</option>', $controlHtml);
        }

        return $this->renderControl('select', $controlHtml, $name, '', $options);
    }

    public function selectMonths($name, $value = null, array $options = [], array $optionOptions = [])
    {
        $monthOptions = [
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        if (($options['optionsFormat'] ?? '') === 'slugs') {
            $monthOptions = [
                'january' => 'January',
                'february' => 'February',
                'march' => 'March',
                'april' => 'April',
                'may' => 'May',
                'june' => 'June',
                'july' => 'July',
                'august' => 'August',
                'september' => 'September',
                'october' => 'October',
                'november' => 'November',
                'december' => 'December',
            ];
        }

        return $this->select($name, $monthOptions, $value, $options, $optionOptions);
    }

    public function selectWeekdays($name, $value = null, array $options = [], array $optionOptions = [])
    {
        $monthOptions = [
            '1' => 'Sunday',
            '2' => 'Monday',
            '3' => 'Tuesday',
            '4' => 'Wednesday',
            '5' => 'Thursday',
            '6' => 'Friday',
            '7' => 'Saturday',
        ];

        if (($options['optionsFormat'] ?? '') === 'slugs') {
            $monthOptions = [
                'sunday' => 'Sunday',
                'monday' => 'Monday',
                'tuesday' => 'Tuesday',
                'wednesday' => 'Wednesday',
                'thursday' => 'Thursday',
                'friday' => 'Friday',
                'saturday' => 'Saturday',
            ];
        }

        return $this->select($name, $monthOptions, $value, $options, $optionOptions);
    }

    public function selectRangeWithInterval(
        string $name,
        int $start,
        int $end,
        int $interval,
        int $value = null,
        array $options = [],
        array $optionOptions = []
    ) : string {
        if ($interval == 0) {
            return parent::selectRange($name, $start, $end, $value, $options);
        }

        $items = [];
        if ($value !== null) {
            $items[$value] = $value;
        }

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

        return $this->select($name, $items, $value, $options, $optionOptions);
    }

    public function date($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control', 'datetimepicker-input']);
        $options['autocomplete'] = 'noway';
        $options['data-target'] = "#datetimepicker-{$name}";
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::date($name, $value, $controlOptions);
        $options['value'] = $this->getValueAttribute($name, $value);

        return $this->renderControl('date', $controlHtml, $name, $value, $options);
    }

    public function datetime($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control', 'datetimepicker-input']);
        $options['autocomplete'] = 'noway';
        $options['subFormClass'] = $this->subFormClass;
        $options['data-target'] = ($this->subFormClass ?: '') . " #datetimepicker-{$name}";
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::datetime($name, $value, $controlOptions);
        $options['value'] = $this->getValueAttribute($name, $value);

        return $this->renderControl('datetime', $controlHtml, $name, $value, $options);
    }

    public function signature($name, $value = null, $options = [])
    {
        if (! array_key_exists('label', $options)) {
            $options['label'] = ucwords(str_replace('_id', '', str_replace('[]', '', $name)));
        }

        if (! array_key_exists('clearButton', $options)) {
            $options['clearButton'] = 'Clear';
        }

        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlHtml = $this->hidden($name) . $this->hidden($name . '_date');

        return $this->renderControl('signature', $controlHtml, $name, $value, $options);
    }

    public function submit($value = null, $options = [])
    {
        $options = $this->setOptionClasses('', $options, ['btn', 'btn-primary']);
        $controlOptions = $this->getControlOptions(collect($options));
        $controlOptions = $controlOptions->map(function ($option) {
            $option = str_replace('form-control-success', '', $option);
            $option = str_replace('form-control-warning', '', $option);
            $option = str_replace('form-control-danger', '', $option);

            return $option;
        });
        $controlHtml = parent::submit($value, $controlOptions->toArray());

        return $this->renderControl('submit', $controlHtml, '', '', $options);
    }

    public function cancelButton($returnUrl = '')
    {
        return '<a href="' . ($returnUrl ?: $this->url->previous()) . '">' .
                $this->button('Cancel', ['class' => 'btn btn-cancel   pull-right']) .
                '</a>';
    }

    public function button($value = null, $options = [])
    {
        $options = $this->setOptionClasses('', $options, ['btn']);
        $label = $options['label'] ?? '';
        $controlHtml = parent::button($value, $options);

        return $this->renderControl('button', $controlHtml, $label, '', $options);
    }

    public function buttonGroup(array $options = [])
    {
        $label = $options['label'] ?? '';
        $options = $this->setOptionClasses('', $options, ['btn-group']);
        $controlHtml = $this->toHtmlString('<div ' . $this->html->attributes($options) . '>');
        $this->isInButtonGroup = true;

        return $this->renderControl('buttonGroup', $controlHtml, '', $label, $options);
    }

    public function endButtonGroup()
    {
        $this->isInButtonGroup = false;

        return $this->renderControl('endButtonGroup', '', '', '', []);
    }
}
