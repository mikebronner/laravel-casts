@include('genealabs-laravel-casts::components.bootstrap3.form-group-open')

@if($type !== 'checkbox')
    @include('genealabs-laravel-casts::components.bootstrap3.label')
@endif

@include("genealabs-laravel-casts::components.bootstrap3.{$type}")
@include('genealabs-laravel-casts::components.bootstrap3.form-group-close')
