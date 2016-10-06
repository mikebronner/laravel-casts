<?php namespace GeneaLabs\LaravelCasts;

use Collective\Html\FormBuilder as Form;
use GeneaLabs\LaravelCasts\Traits\CurrentFormBuilderMethods;
use GeneaLabs\LaravelCasts\Traits\CurrentOrLtsLaravelVersion;
use GeneaLabs\LaravelCasts\Traits\LtsFormBuilderMethods;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Collection;

class FormBuilder extends Form
{
    use CurrentFormBuilderMethods;
    use CurrentOrLtsLaravelVersion;
    use LtsFormBuilderMethods;

    protected $errors;
    protected $offset = 0;
    protected $labelWidth = 3;
    protected $fieldWidth = 9;
    protected $isHorizontal = false;
    protected $isInline = false;
    protected $framework = 'vanilla';

    private function renderControlForLaravelCurrent(
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
            $this->errors,
        ];

        return call_user_func_array($method, $parameters);
    }

    public function token()
    {
        return $this->hidden('_token', csrf_token());
    }

    public function selectRangeWithInterval(
        string $name,
        int $start,
        int $end,
        int $interval,
        int $value = null,
        array $options = []
    ) : string {
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

    public function select($name, $list = [], $selected = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $labelHtml = $this->label($name, array_pull($options, 'label'));
        $controlHtml = parent::select($name, $list, $selected, $options);

        return $this->renderControl('select', $controlHtml, $name, '', $options);
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

        if (array_key_exists('framework', $options)) {
            $this->framework = $options['framework'];
        }

        if (array_key_exists('labelWidth', $options)) {
            $this->labelWidth = $options['labelWidth'];
        }

        if (array_key_exists('fieldWidth', $options)) {
            $this->fieldWidth = $options['fieldWidth'];
        }
    }


    public function label($name, $label = null, $options = [], $escapeHtml = true)
    {
        $label = array_pull($options, 'label') ?? $label ?? '';
        $options = $this->setLabelOptionClasses($options);

        return parent::label($name, $label, $options, $escapeHtml);
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

    public function date($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::date($name, $value, $controlOptions);

        return $this->renderControl('date', $controlHtml, $name, $value, $options);
    }

    public function datetime($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = array_filter($options, function ($key) {
            return ($key !== 'label');
        }, ARRAY_FILTER_USE_KEY);
        $controlHtml = parent::datetime($name, $value, $controlOptions);

        return $this->renderControl('datetime', $controlHtml, $name, $value, $options);
    }

    public function email($name, $value = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $controlOptions = $this->getControlOptions(collect($options));
        $controlHtml = parent::email($name, $value, $controlOptions->toArray());

        return $this->renderControl('email', $controlHtml, $name, $value, $options);
    }

    public function combobox($name, $list = [], $selected = null, $options = [])
    {
        $options = $this->setOptionClasses($name, $options, ['form-control']);
        $options['multiple'] = '';

        return $this->select($name, $list, $selected, $options);
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
        $label = $options['label'];
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


    public function submit($value = null, $options = [])
    {
        $cancelUrl = array_key_exists('cancelUrl', $options) ? $options['cancelUrl'] : null;
        $cancelHtml = '';
        $options = $this->setOptionClasses('', $options, ['btn', 'btn-primary']);
        $controlOptions = $this->getControlOptions(collect($options));
        $controlHtml = parent::submit($value, $controlOptions->toArray());

        if (! is_null($cancelUrl)) {
            $cancelHtml = link_to($cancelUrl, 'Cancel', ['class' => 'btn btn-cancel pull-right']);
        }

        // TODO: render cancel and reset buttons.
        return $this->renderControl('submit', $controlHtml, '', '', $options);
    }

    public function cancelButton($returnUrl = '')
    {
        return '<a href="' .
                $this->url->previous() . '">' .
                $this->button('Cancel', ['class' => 'btn btn-cancel   pull-right']) .
                '</a>';
    }

    private function setOptionClasses(string $name, array $options, array $addClasses = []) : array
    {
        $classes = [];

        if (array_key_exists('class', $options)) {
            $classes = explode(' ', $options['class']);
        }

        if (count($this->errors)) {
            if ($this->framework === 'bootstrap3') {
                $classes[] = $this->errors->has($name) ? 'has-error' : 'has-success';
            }

            if ($this->framework === 'bootstrap4') {
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

    private function getControlOptions(Collection $options, array $additionalExclusions = []) : Collection
    {
        $additionalExclusions = collect($additionalExclusions)->flip();

        $options = $options->map(function ($value, $key) use ($additionalExclusions) {
            $excludedKeys = collect([
                'label' => '',
            ]);
            $excludedKeys = $excludedKeys->merge($additionalExclusions);

            return ($excludedKeys->has($key) ? null : $value);
        });

        return $options->filter(function ($value) use ($additionalExclusions) {
            return ($value !== null);
        });
    }
}
