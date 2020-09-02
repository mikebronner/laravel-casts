<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        type="week"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
