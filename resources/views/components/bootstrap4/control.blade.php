@if((! $isInButtonGroup && $type !== 'endButtonGroup') || ($isInButtonGroup && $type === 'buttonGroup'))
    @include('genealabs-laravel-casts::components.bootstrap4.form-group-open')

    @if($type !== 'checkbox' && $type !== 'submit')
        @include('genealabs-laravel-casts::components.bootstrap4.label')
    @endif
@endif

@include("genealabs-laravel-casts::components.bootstrap4.{$type}")

@if(! $isInButtonGroup)
    @include('genealabs-laravel-casts::components.bootstrap4.form-group-close')
@endif
