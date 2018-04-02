@if (((! $isInButtonGroup && $type !== 'endButtonGroup') || ($isInButtonGroup && $type === 'buttonGroup')) && $type !== 'subform')
    @include ('genealabs-laravel-casts::components.bootstrap4.form-group-open')

    @if ($type !== 'checkbox' && $type !== 'submit' && $type !== 'file')
        @label ($name, $name, ['label' => $options['label'] ?? ''], $options['escapeLabel'] ?? false)
    @endif
@endif

@include ("genealabs-laravel-casts::components.bootstrap4.{$type}")

@if (! $isInButtonGroup && $type !== 'subform')
    @include('genealabs-laravel-casts::components.bootstrap4.form-group-close')
@endif
