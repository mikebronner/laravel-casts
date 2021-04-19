<input
    {{ $attributes->except(['x-show', 'x-if']) }}
    type="hidden"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ $value }}"
>
