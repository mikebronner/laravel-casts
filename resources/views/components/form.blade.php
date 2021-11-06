@push ("js")
    <script>
        if (typeof window.resetForm === "undefined") {
            window.resetForm = function (form) {
                _.each(form.elements, function (element) {
                    if (element.type === "submit") {
                        element.disabled = false;
                    }
                });
            };
        }

        if (typeof window.submitForm === "undefined") {
            window.submitForm = function (form) {
                _.each(form.elements, function (element) {
                    if (element.type === "submit") {
                        element.disabled = true;
                    }
                });
            };
        }
    </script>
@endpush

<form
    {{ $attributes }}
    autocomplete="{{ $autocomplete }}"
    class="{{ $class }}"
    enctype="{{ $enctype }}"
    id="form-{{ $key }}"
    method="{{ in_array(strtolower($method), ['post', 'get']) ? strtoupper($method) : 'POST' }}"
    target="{{ $target }}"

    @if ($action)
        action="{{ $action }}"
        onsubmit="window.submitForm(this);"
        onreset="window.resetForm(this);"
    @else
        onsubmit="window.submitForm(this); return false;"
        onreset="window.resetForm(this);"
    @endif
>
    @csrf()
    @method($method)

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Livewire.hook("message.processed", (component) => {
                window.resetForm(document.getElementById("form-{{ $key }}"));
            });
        });
    </script>

    {!! $slot !!}

</form>
