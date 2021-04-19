<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
    :errors="$errorData"
    :helpText="$helpText"
    :name="$name"
>
    <input
        {{ $attributes->except(['x-show', 'x-if']) }}
        type="week"
        :name="$name"
        :value="$value"
    >
</x-form-group>
