@if((! $isInButtonGroup && $type !== 'endButtonGroup') || ($isInButtonGroup && $type === 'buttonGroup'))
    @include('genealabs-laravel-casts::components.bootstrap3.form-group-open')

    @if($type !== 'checkbox' && $type !== 'radio' && $type !== 'submit' && $type !== 'signature')
        @include('genealabs-laravel-casts::components.bootstrap3.label')
    @endif
@endif

@include("genealabs-laravel-casts::components.bootstrap3.{$type}")

@if(! $isInButtonGroup)
    @include('genealabs-laravel-casts::components.bootstrap3.form-group-close')
@endif
