<form
    {{ $attributes }}
    action="{{ $action }}"
    autocomplete="{{ $autocomplete }}"
    class="{{ $class }}"
    enctype="{{ $enctype }}"
    method="{{ in_array(strtolower($method), ['post', 'get']) ? strtoupper($method) : 'POST' }}"
    target="{{ $target }}"
>
    @csrf()
    @method($method)

    {!! $slot !!}

</form>
