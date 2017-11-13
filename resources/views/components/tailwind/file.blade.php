<div class="file-field form-control-group">
    <input type="text" name="{{ $name }}" class="form-control file-name" placeholder="No File Selected ..." disabled="disabled">
    <button type="button" class="file-button">

        <input id="file1" name="file1" type="file">
        {{-- @include ('genealabs-laravel-casts::components.tailwind.input') --}}

        Browse ...

    </button>
</div>

@section ('genealabs-laravel-casts')
    @parent

    <script>
        window['genealabsLaravelCasts'] = window.genealabsLaravelCasts || {};
        window.genealabsLaravelCasts['fileLoaders'] = window.genealabsLaravelCasts.fileLoaders || [];
        window.genealabsLaravelCasts['framework'] = window.genealabsLaravelCasts.framework || 'tailwind';
        window.genealabsLaravelCasts.fileLoaders.push(function () {
            document.getElementById("{{ $options['id'] }}-file-button").onchange = function () {
                document.getElementById("{{ $options['id'] }}").value = this.value;
            };
        });
    </script>
@endsection
