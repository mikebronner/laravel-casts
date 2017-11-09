@php
    $wrapperClass = (! $errors->isEmpty() && $errors->has($name))
        ? ' failure'
        : (! $errors->isEmpty() && ! $errors->has($name)
            ? ' success'
            : '');
@endphp

<div class="form-group{{ $wrapperClass }}">

    @label ($name, $name, $options, $options['escapeLabel'] ?? false)

    @include("genealabs-laravel-casts::components.tailwind.{$type}")

    @if(! $errors->isEmpty() && $errors->has($name))
        <p class="help-text">{{ implode(' ', $errors->get($name)) }}</p>
    @endif

</div>
