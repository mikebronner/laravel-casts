<form
    {{ $attributes }}
    action="{{ $action }}"
    autocomplete="{{ $autocomplete }}"
    class="{{ $class }}"
    enctype="{{ $enctype }}"
    method="POST"
    target="{{ $target }}"
>
    @csrf()
    @method($method)

    {!! $slot !!}

</form>
