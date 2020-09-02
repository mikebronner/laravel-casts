<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        type="file"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
