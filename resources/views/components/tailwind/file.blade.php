@if($isHorizontal)
<div class="col-sm-{{ $fieldWidth }}">
@endif

    <div class="custom-file" style="display: block;">
        {!! $controlHtml !!}
        <label class="custom-file-label" id="{{ $name }}-file-name" for="{{ $name }}"></label>
        <span class="custom-file-control{{ $errors->isEmpty() ? '' : ($errors->has($name) ? ' form-control-danger' : ' form-control-success') }}"></span>
    </div>

    @if(! $errors->isEmpty() && $errors->has($name))
        <div class="text-sm text-red-600 italic">{{ implode(' ', $errors->get($name)) }}</div>
    @endif

@if($isHorizontal)
</div>
@endif

@section ('genealabs-laravel-casts')
    @parent

    <script>
        $("#{{ $name }}").on("change", function () {
            var fileName = $("#{{ $name }}").val().split('\\').pop();
            $('#{{ $name }}-file-name').html(fileName);
        });
    </script>
@endsection
