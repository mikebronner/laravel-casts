<div
    class="w-full"
>
    <input
        type="hidden"
        name="{{ $fieldName }}"
        value="{{ $selectedValue }}"
    >
    <input
        id="{{ $fieldName }}"
        class="form-input w-full font-normal"
        wire:keydown.backspace="resetSearch('{{ $id }}')"
        wire:model="search"
        type="text"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        name="search"
    >

    @if (! $createFormIsVisible && ! $selectedValue && $search)
        <div
            class="absolute z-50 bg-white border border-gray-300 rounded shadow-md"
        >

            @if ($search && $results->isEmpty())
                @if ($createFormView)
                    <div
                        wire:click="showCreateForm('{{ $id }}')"
                        class="px-3 py-1 block cursor-pointer bg-transparent hover:bg-gray-300"
                    >
                        Add {{ $search }} ...
                    </div>
                @else
                    <div
                        class="px-3 py-1 block bg-transparent"
                    >
                        No results found.
                    </div>
                @endif
            @endif

            @foreach ($results as $result)
                <div
                    class="px-3 py-1 block cursor-pointer bg-transparent hover:bg-gray-300"
                    wire:click="select('{{ $result->$valueField }}', '{{ $result->$labelField }}', '{{ $id }}')"
                >
                    {{ $result->$labelField }}
                </div>
            @endforeach

        </div>
    @endif

    @if ($createFormIsVisible)
        <fieldset
            class="mt-4 mb-8 border-4 border-blue-400 rounded-lg"
            id="{{ \Illuminate\Support\Str::slug($label) . "-" . $id }}"
            x-data="subFormController('{{ $createFormUrl }}')"
            x-init="() => {loadForm('{{ \Illuminate\Support\Str::slug($label) . "-" . $id }}', '{{ $search }}');}"
        >
            <legend>Add New {{ $label }}</legend>
            @form
            @include ($createFormView)
            <div class="flex">
                @button ("Add New Repository", ["x-on:click" => "submitForm('" . \Illuminate\Support\Str::slug($label) . "-" . $id . "', '" . \Illuminate\Support\Str::slug($label) . "');", "class" => "button button-primary button-outlined"])
                @button ("Cancel", ["wire:click" => "cancelForm('{$id}')", "class" => "button button-secondary button-link"])
            </div>
            @endform
        </fieldset>
    @endif
</div>

<script scoped>
    function subFormController(postUrl) {
        return {
            action : postUrl,

            formData: {
                _token: document.querySelector("meta[name=csrf_token]").getAttribute('content'),
            },

            loadForm: function (id, value) {
                var hasFocused = false;
                var formElements = document.getElementById(id).elements;
console.log(id, formElements);
                for (var i = 0, formElement; formElement = formElements[i++];) {
                    if (hasFocused == false && formElement.type !== "hidden") {
                        formElement.focus();
                        hasFocused = true;
                    }

                    if (formElement.name == "{{ $labelField }}") {
                        formElement.value = value;
                    }
                }
            },

            submitForm: function (id, targetId) {
                if (id != '{{ \Illuminate\Support\Str::slug($label) . "-" . $id }}', '{{ $search }}') {
                    return;
                }

                var formData = new FormData();
                var formElements = document.getElementById(id).elements;

                for (var i = 0, formElement; formElement = formElements[i++];) {
                    if (formElement.name.length > 0
                        && formElement.value.length > 0
                    ) {
                        this.formData[formElement.name] = formElement.value;
                    }
                }

                for (let [key, value] of Object.entries(this.formData)) {
                    formData.append(key, value);
                }

                axios
                    .post(this.action, formData)
                    .then(function (response) {
                        window.livewire.emit('updateSelectedItem-{{ $id }}', response.data, '{{ $id }}');
                    })
                    .catch(function (error) {
                        if ((((error || {}).response || {}).status || 200) === 422) {
                            window.livewire.emit('setErrors-{{ $id }}', error.response.data, '{{ $id }}');
                        } else {
                            console.error(error);
                        }
                    });
            },
        };
    }
</script>
