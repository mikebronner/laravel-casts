<button
    {{ $attributes->merge(["class" => "form-button cursor-pointer"]) }}
    name="{{ $name }}"
    type="submit"
>
    {{ $icon ?? "" }}
    {{ $value ?? "Save" }}
</button>
