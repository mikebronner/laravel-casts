<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        type="date"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
