@if((! $isInButtonGroup && $type !== 'endButtonGroup') || ($isInButtonGroup && $type === 'buttonGroup'))
    @include('genealabs-laravel-casts::components.bootstrap4.form-group-open')

    @if($type !== 'checkbox' && $type !== 'submit')
        @label ($name, $name, ['label' => $options['label'] ?? ''], $options['escapeLabel'] ?? false)
    @endif
@endif

@include("genealabs-laravel-casts::components.bootstrap4.{$type}")

@if(! $isInButtonGroup)
    @include('genealabs-laravel-casts::components.bootstrap4.form-group-close')
@endif
