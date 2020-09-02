<div
    {{ $attributes }}
>
    {!! $slot !!}
    <x-form-errors :errors="$errors" />
</div>
