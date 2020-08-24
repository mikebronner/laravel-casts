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
        type="password"
        id="{{ $name }}"
        name="{{ $name }}"
        {!! $fieldAttributes !!}
    >
</x-form-group>
