<x-form-group
    {{ $attributes->only(['x-show', 'x-if']) }}
    :class="$groupClasses"
>
    @if ($label)
        <x-form-label
            :field="$name"
            :value="$label"
            :class="$labelClasses"
        />
    @endif

    <div
        {{ $attributes->whereDoesntStartWith(["x-", "wire:"])->merge(["class" => "relative overflow-hidden file-upload-field"]) }}
        x-data="imageUploader()"
    >
        <input
            class="m-0 p-0 w-full h-full text-center bg-contain border-0 cursor-pointer"
            type="text"
            x-bind:placeholder="placeholderText()"
            x-bind:style="'background-color: ' + (imagePreviewData.length > 0 ? 'transparent' : 'white') + '; background-repeat: no-repeat; background-position: center center; background-image: url(' + imagePreviewData + '); caret-color: transparent;'"
            x-on:click="showFileUploadDialogue"
            x-on:dragover.stop.prevent=""
            x-on:drop.stop.prevent="captureFile"
            x-on:paste.prevent
            x-ref="{{ $name }}-text"
        >
        <input
            {{ $attributes->only(['wire:model']) }}
            class="hidden"
            type="file"
            x-on:change="previewImage"
            x-ref="{{ $name }}-file"
        >
        <p
            class="px-3 py-1 w-full absolute bottom-0 flex items-center justify-between overflow-hidden text-white bg-gray-400"
            x-show="fileUri.length > 0"
        >
            <span
                class=""
                x-html="fileName()"
            ></span>
            <svg
                aria-hidden="true"
                class="w-4 h-4 cursor-pointer fill-current"
                data-icon="trash-alt"
                data-prefix="fas"
                focusable="false"
                role="img"
                viewBox="0 0 448 512"
                x-on:click="clearImage()"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"
                ></path>
            </svg>
        </p>
    </div>

    @error($nameInDotNotation)
        <p class="mt-1 text-sm text-red-600">
            {{ str_replace($nameInDotNotation, "'{$label}'", $message) }}
        </p>
    @enderror

    <span class="text-sm italic text-gray-400">
        {{ $helpText }}
    </span>

    <style>
        .file-upload-field {
            background: -webkit-linear-gradient(45deg, rgb(0, 0, 0, 0.33) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.33) 75%, rgba(0, 0, 0, 0.33) 0), -webkit-linear-gradient(45deg, rgba(0, 0, 0, 0.33) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.33) 75%, rgba(0, 0, 0, 0.33) 0), white;
            background: -moz-linear-gradient(45deg, rgb(0, 0, 0, 0.33) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.33) 75%, rgba(0, 0, 0, 0.33) 0), -moz-linear-gradient(45deg, rgba(0, 0, 0, 0.33) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.33) 75%, rgba(0, 0, 0, 0.33) 0), white;
            background: linear-gradient(45deg, rgb(0, 0, 0, 0.33) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.33) 75%, rgba(0, 0, 0, 0.33) 0), linear-gradient(45deg, rgba(0, 0, 0, 0.33) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.33) 75%, rgba(0, 0, 0, 0.33) 0), white;
            background-repeat: repeat, repeat;
            background-position: 0px 0, 5px 5px;
            transform-origin: 0 0 0;
            background-origin: padding-box, padding-box;
            background-clip: border-box, border-box;
            background-size: 10px 10px, 10px 10px;
            box-shadow: none;
            text-shadow: none;
            transition: none;
            transform: scaleX(1) scaleY(1) scaleZ(1);
        }
    </style>
    <script>
        function imageUploader()
        {
            return {
                fieldName: "{{ $name }}",
                fileUri: "{{ $value }}",
                imagePreviewData: "{{ $value }}",

                fileName: function () {
                    let fileName = this.fileUri.split('\\').pop().split('/').pop();
                    const fileLength = fileName.length;
                    let maxLength = 45;

                    if (this.$refs[this.fieldName + '-text']) {
                        maxLength = this.$refs[this.fieldName + '-text'].clientWidth
                            / parseFloat(getComputedStyle(document.querySelector('body'))['font-size'])
                            * 1.25;
                    }

                    if (fileLength > maxLength) {
                        fileName = "&hellip;" + fileName.substring(fileLength - maxLength);
                    }

                    return fileName;
                },

                placeholderText: function () {
                    return this.imagePreviewData.length > 0
                        ? ""
                        : "Drag & drop a file, or click to browse.";
                },

                processUriList: function (event) {
                    const data = event.dataTransfer.getData("text/uri-list");

                    if ((data || false) === false) {
                        return false;
                    }

                    this.handleChange(data);

                    return true;
                },

                processText: function (event) {
                    const data = event.dataTransfer.getData("text");

                    if ((data || false) === false) {
                        return false;
                    }

                    this.handleChange(data);

                    return true;
                },

                processHtmlText: function (event) {
                    const data = event.dataTransfer.getData("text/html");
                    const sourceRegExp = /src=['"](.*?)['"]/;
                    const match = sourceRegExp.exec(data);

                    if (match && match.length > 0) {
                        this.handleChange(match[1]);

                        return true;
                    }

                    return false;
                },

                processFiles: function (event) {
                    if (event.dataTransfer.files.length > 0) {
                        this.$refs[this.fieldName + '-file'].files = event.dataTransfer.files;
                        this.$refs[this.fieldName + '-file'].dispatchEvent(new Event('change', { 'bubbles': true }));

                        return true;
                    }

                    return false;
                },

                captureFile: function (event) {
                    let result = false;
                    if (! result) {
                        result = this.processUriList(event);
                    }
                    if (! result) {
                        this.processText(event);
                    }
                    if (! result) {
                        this.processHtmlText(event);
                    }
                    if (! result) {
                        this.processFiles(event);
                    }
                },

                clearImage: function () {
                    this.imagePreviewData = "";
                    this.fileUri = "";
                    this.value = null;
                    this.$refs[this.fieldName + '-file'].value = null;
                    this.$refs[this.fieldName + '-file'].files = null;
                    this.$refs[this.fieldName + '-file'].dispatchEvent(new Event('change', { 'bubbles': true }));
                },

                handleChange: function (value) {
                    this.fileUri = value;
                    this.imagePreviewData = value;
                    this.value = value;
                },

                previewImage: function (event) {
                    var input = event.target;
                    var self = this;
                    this.fileUri = input.value;
                    if (input.files
                        && input.files[0]
                    ) {
                        var reader = new FileReader();
                        this.image = Object.assign({}, this.image, {
                            file: input.files[0],
                        });
                        reader.onload = function (event) {
                            var imageData = event.target.result;
                            self.imagePreviewData = "";
                            if (imageData.indexOf("data:;base64,") === 0) {
                                self.imagePreviewData = "";
                                imageData = atob(imageData.replace("data:;base64,", ""));
                                imageData = imageData.substring(18, imageData.length - 35);
                                self.fileUri = imageData;
                                self.imagePreviewData = imageData;
                            }
                            if (imageData.indexOf("data:image") === 0) {
                                self.imagePreviewData = imageData;
                            }
                        }
                        reader.readAsDataURL(input.files[0]);
                        this.value = input.files[0];
                    }
                },

                showFileUploadDialogue: function () {
                    this.$refs[this.fieldName + '-file'].click();
                },
            };
        }
    </script>
</x-form-group>
