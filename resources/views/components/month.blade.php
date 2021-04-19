<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
    :errors="$errorData"
    :helpText="$helpText"
>
    <input
        {{ $attributes->except(['x-show', 'x-if']) }}
        type="month"
        :name="$name"
        :value="$value"
    >
</x-form-group>
