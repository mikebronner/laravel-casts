<x-form-label
    :field="$name"
    :value="$label"
    :attributes="['class' => $labelClasses]"
>
    <input
        id="{{ $name }}"
        type="checkbox"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $checked }}
        {!! $fieldAttributes !!}
    >
</x-form-label>
