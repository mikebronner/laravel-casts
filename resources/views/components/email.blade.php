<x-form-group
    class="{{ $groupClasses }}"
    :errors="$errors"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            :attributes="['class' => $labelClasses]"
        />
    @endif

    <input
        type="email"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {!! $fieldAttributes !!}
    >
</x-form-group>
