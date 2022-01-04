@push ("css")
    <style>
        .form-input[disabled="disabled"] + p.text-red-600,
        .form-select[disabled="disabled"] + p.text-red-600,
        .form-textarea[disabled="disabled"] + p.text-red-600,
        {
            display: none;
        }
    </style>
@endpush

<div
    {{ $attributes }}
>
    {{ $slot }}
</div>
