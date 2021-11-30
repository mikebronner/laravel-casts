<x-form-group
    {{ $attributes->whereStartsWith(['x-', 'wire:']) }}
    :class="$groupClasses"
    wire:ignore
>

    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            class="{{ $labelClasses }}"
        />
    @endif

    <div
        {{ $attributes->merge(["class" => ""])->whereDoesntStartWith(['x-', 'wire:']) }}
        x-data="tinymceAlpine()"
        x-init="init()"
        class="relative flex flex-col rounded-lg document-editor"
    >
        <div
            id="{{ $name }}"
        >
            {!! $value !!}
        </div>
    </div>

    @error($nameInDotNotation)
        <p class="mt-1 text-sm text-red-600">
            {{ str_replace($nameInDotNotation, "'{$label}'", $message) }}
        </p>
    @enderror

    <span
        class="text-sm italic text-gray-400"
    >
        {{ $helpText }}
    </span>
    {{-- Todo: add npm package instead --}}
    <script
        src="https://cdn.tiny.cloud/1/{{ config("services.tinymce.api-key", "please-add-your-api-key") }}/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"
    ></script>
    <script>
        function tinymceAlpine()
        {
            return {
                editor: null,

                init: function () {
                    let self = this;

                    tinymce.init({
                        selector: '#{{ $name }}',
                        forced_root_block : false,
                        menubar: '',
                        plugins: 'advcode casechange export fullscreen hr autolink lists image advlist pagebreak powerpaste searchreplace table advtable wordcount',
                        toolbar: 'undo redo | styleselect | bold italic underline strikethrough superscript subscript removeformat pagebreak hr wordcount | align | outdent indent | bullist numlist table image | casechange searchreplace | spellchecker spellcheckdialog | code export fullscreen',
                        toolbar_mode: 'sliding',
                        init_instance_callback: function (editor) {
                            editor.on('KeyUp Change Undo Redo Paste', function (e) {
                                self.changed(tinymce.activeEditor.getContent());
                            });

                            editor.on("drop", function(e) {
                                if (e.dataTransfer.items) {
                                    for (let i = 0; i < e.dataTransfer.items.length; i++) {
                                        if (e.dataTransfer.items[i].kind === 'file') {
                                            e.preventDefault();

                                            let file = e.dataTransfer.items[i].getAsFile();

                                            self.dropHandler(editor, file);
                                        }
                                    }
                                } else {
                                    for (let i = 0; i < e.dataTransfer.files.length; i++) {
                                        e.preventDefault();

                                        let file = e.dataTransfer.items[i].getAsFile();

                                        self.dropHandler(editor, file);
                                    }
                                }
                            });
                        },
                        relative_urls : false,
                        document_base_url : "{ url('/'); }",
                        images_upload_handler: this.imageUploadHandler,
                        max_height: 600,
                        branding: false,
                        paste_data_images: false,
                        pagebreak_separator: '<div style="page-break-before: always;"></div>',
                        images_dataimg_filter: function (img) {
                            return !img.hasAttribute('internal-blob');
                        }
                    });

                    document.dispatchEvent(new CustomEvent("editor", {
                        bubbles: true,
                        detail: this.editor,
                    }));
                },

                changed: function (data) {
                    document.dispatchEvent(new CustomEvent("input", {
                        bubbles: true,
                        detail: data,
                    }));
                },

                dropHandler: function (editor, file) {
                    const reader = new FileReader();

                    reader.onloadend = function () {
                        editor.execCommand('mceInsertContent', false, `<img src="${reader.result}"></img>`);
                    };

                    reader.readAsDataURL(file);
                },

                imageUploadHandler: function (blobInfo, success, failure, progress) {
                    var xhr, formData;

                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '{{ $uploadPath }}');
                    xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}")

                    xhr.upload.onprogress = function (e) {
                        progress(e.loaded / e.total * 100);
                    };

                    xhr.onload = function() {
                        var json;

                        if (xhr.status === 403) {
                            failure('HTTP Error: ' + xhr.status, { remove: true });
                            return;
                        }

                        if (xhr.status < 200 || xhr.status >= 300) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }

                        json = JSON.parse(xhr.responseText);

                        if (!json || typeof json.location != 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }

                        success(json.location);
                    };

                    xhr.onerror = function () {
                        failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                    };

                    formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    xhr.send(formData);
                },
            };
        }
    </script>
</x-form-group>
