<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        type="number"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
