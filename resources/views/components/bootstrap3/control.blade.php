@include('genealabs-laravel-casts::components.bootstrap3.form-group-open')

@if($type !== 'checkbox' && $type !== 'radio' && $type !== 'submit' && $type !== 'signature')
    @include('genealabs-laravel-casts::components.bootstrap3.label')
@endif

@include("genealabs-laravel-casts::components.bootstrap3.{$type}")
@include('genealabs-laravel-casts::components.bootstrap3.form-group-close')
