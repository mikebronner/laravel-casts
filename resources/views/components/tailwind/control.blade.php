@php
    $wrapperClass = (! $errors->isEmpty() && $errors->has($name))
        ? ' failure'
        : (! $errors->isEmpty() && ! $errors->has($name)
            ? ' success'
            : '');
@endphp

<div class="form-group{{ $wrapperClass }}">

    @if ($type !== 'checkbox' && $type !== 'radio')
        @label ($name, $name, $options, $options['escapeLabel'] ?? false)
    @endif

    @include("genealabs-laravel-casts::components.tailwind.{$type}")

    @if(! $errors->isEmpty() && $errors->has($name))
        <p class="help-text">{{ implode(' ', $errors->get($name)) }}</p>
    @endif

</div>
