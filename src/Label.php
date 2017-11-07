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
        $value = str_replace('_id', '', $value);
        $value = str_replace('[]', '', $value);
        $value = $options['label'] ?? (ucwords($value) ?: '');
        $options['class'] = $options['class'] ?? '';

        parent::__construct($name, $value, $options);

        if ($this->framework === 'bootstrap3') {
            $options['class'] .= ' col-sm-' . app('form')->labelWidth . ' control-label';
        }

        if ($this->framework === 'bootstrap4') {
            $options['class'] .= ' col-sm-' . app('form')->labelWidth . ' col-form-label';
        }

        $this->excludedKeys = $this->excludedKeys->merge(collect([
            'autocomplete' => '',
            'data-target' => '',
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
        ]));
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
}
