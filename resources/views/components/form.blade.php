<form
    action="{{ $action }}"
    autocomplete="{{ $autocomplete }}"
    class="{{ $class }}"
    enctype="{{ $enctype }}"
    method="{{ $method }}"
    target="{{ $target }}"
    {{ $novalidate }}
>
    @csrf
    {!! $slot !!}
</form>
