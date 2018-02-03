@if (((! $isInButtonGroup && $type !== 'endButtonGroup') || ($isInButtonGroup && $type === 'buttonGroup')) && $type !== 'subform')
    @include('genealabs-laravel-casts::components.bootstrap3.form-group-open')

    @if($type !== 'checkbox' && $type !== 'radio' && $type !== 'submit' && $type !== 'signature')
        @label ($name, $name, ['label' => $options['label'] ?? ''], $options['escapeLabel'] ?? false)
    @endif
@endif

@include ("genealabs-laravel-casts::components.bootstrap3.{$type}")

@if (! $isInButtonGroup && $type !== 'subform')
    @include('genealabs-laravel-casts::components.bootstrap3.form-group-close')
@endif
