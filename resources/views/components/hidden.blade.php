<x-form-group
    :class="$groupClasses"
    :errors="$errors"
>
    <input
        type="hidden"
        :name="$name"
        :value="$value"
        {!! $fieldAttributes !!}
    >
</x-form-group>
