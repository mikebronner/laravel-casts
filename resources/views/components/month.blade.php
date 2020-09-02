<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        type="month"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
