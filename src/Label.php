<?php namespace GeneaLabs\LaravelCasts;

class Label extends Component
{
    protected $escapeHtml;
    protected $excludedClasses;

    /**
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function __construct(string $name, $value = null, array $options = [], bool $escapeHtml = true)
    {
        $name = str_replace('_id', '', $name);
        $name = str_replace('[]', '', $name);
        $value = $options['label'] ?? ($value ?: '');
        $options['class'] = '';

        parent::__construct($name, $value, $options);

        $this->classes = '';

        if ($this->framework === 'bootstrap3') {
            $this->classes = 'col-sm-' . app('form')->labelWidth . ' control-label';
        }

        if ($this->framework === 'bootstrap4') {
            $this->classes = 'col-sm-' . app('form')->labelWidth . ' col-form-label';
        }

        $this->excludedKeys = collect([
            'autocomplete' => '',
            'data-target' => '',
            'label' => '',
            'list' => '',
            'placeholder' => '',
            'selected' => '',
            'subFormAction' => '',
            'subFormBlade' => '',
            'subFormClass' => '',
            'subFormFieldName' => '',
            'subFormMethod' => '',
            'subFormTitle' => '',
            'subFormResponseObjectPrimaryKey' => '',
        ]);
        $this->excludedClasses = collect([
            'custom-file-input' => '',
            'custom-select' => '',
            'btn-primary' => '',
            'btn-default' => '',
            'btn-danger' => '',
            'btn-warning' => '',
            'btn-success' => '',
            'btn-secondary' => '',
            'btn' => '',
            'datetimepicker-input' => '',
            'form-control' => '',
            'form-control-file' => '',
            'form-control-success' => '',
            'form-control-warning' => '',
            'form-control-danger' => '',
        ]);
        $this->escapeHtml = $escapeHtml;
    }

    protected function renderBaseControl() : string
    {
        if (! $this->name && ! $this->value) {
            return '';
        }

        return app('form')->callParentMethod(
            $this->type,
            $this->name,
            $this->value,
            $this->options,
            $this->escapeHtml
        );
    }

    public function getHtmlAttribute() : string
    {
        return $this->renderBaseControl();
    }

    public function getOptionsAttribute() : array
    {
        return collect(parent::getOptionsAttribute())
            ->map(function ($value, $key) {
                if ($key !== 'class') {
                    return trim($value);
                }

                return collect(explode(' ', $value))
                    ->filter(function ($class) {
                        return ($this->excludedClasses->has($class) ? null : $class);
                    })
                    ->implode(' ');
            })
            ->unique()
            ->filter()
            ->toArray();
    }
}
