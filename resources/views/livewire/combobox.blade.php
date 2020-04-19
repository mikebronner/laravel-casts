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
        wire:keydown.backspace="resetSearch"
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
                <div
                    wire:click="showCreateForm"
                    class="px-3 py-1 block cursor-pointer bg-transparent hover:bg-gray-300"
                >
                    Add {{ $search }} ...
                </div>
            @endif

            @foreach ($results as $result)
                <div
                    class="px-3 py-1 block cursor-pointer bg-transparent hover:bg-gray-300"
                    wire:click="select('{{ $result->$valueField }}', '{{ $result->$labelField }}')"
                >
                    {{ $result->$labelField }}
                </div>
            @endforeach

        </div>
    @endif

    @if ($createFormIsVisible)

        <fieldset
            class="mt-4 mb-8 border-4 border-blue-400 rounded-lg"
            id="{{ \Illuminate\Support\Str::slug($label) }}"
            x-data="subFormController('{{ route(\Illuminate\Support\Str::plural(\Illuminate\Support\Str::slug($label)) . ".store") }}')"
        >
            <legend>Add New {{ $label }}</legend>
            @form
            @include ($createFormView)
            <div class="flex">
                @button ("Add New Repository", ["x-on:click" => "submitForm('" . \Illuminate\Support\Str::slug($label) . "');", "class" => "button button-primary button-outlined"])
                @button ("Cancel", ["wire:click" => "cancelForm", "class" => "button button-secondary button-link"])
            </div>
            @endform
        </fieldset>
    @endif
</div>

<script>
    function subFormController(postUrl) {
        return {
            action : postUrl,
            

            formData: {
                _token: document.querySelector("meta[name=csrf_token]").getAttribute('content'),
            },

            submitForm: function (targetId) {
                var formData = new FormData();
                var formElements = document.getElementById("repository").elements;

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
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        if (error.response.status === 422) {
                            window.livewire.emit('setErrors', error.response.data);
                        } else {
                            console.error(error.response);
                        }
                    });
            },
        };
    }
</script>
