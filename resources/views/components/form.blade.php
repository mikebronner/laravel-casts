<form
    action="{{ $action }}"
    autocomplete="{{ $autocomplete }}"
    class="{{ $class }}"
    enctype="{{ $enctype }}"
    method="{{ $method }}"
    target="{{ $target }}"
>
    @csrf()
    @method($method)

    {!! $slot !!}

</form>
