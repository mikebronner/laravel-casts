<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        type="color"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
