<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        type="time"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
