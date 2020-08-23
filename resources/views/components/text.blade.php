<x-form-group
    :attributes="['class' => $groupClasses]"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            :attributes="['class' => $labelClasses]"
        />
    @endif

    <input
        type="text"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {!! $fieldAttributes !!}
    >
</x-form-group>
