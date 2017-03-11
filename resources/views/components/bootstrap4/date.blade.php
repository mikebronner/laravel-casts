@if($isHorizontal)
<div class="col-sm-{{ $fieldWidth }}">
@endif

    {!! $controlHtml !!}

    <script>
        window['genealabsLaravelCasts'] = window.genealabsLaravelCasts || {};
        window.genealabsLaravelCasts['dateTimeLoaders'] = window.genealabsLaravelCasts.dateTimeLoaders || [];
        window.genealabsLaravelCasts.dateTimeLoaders.push(function () {
            $("[name='{{ $name }}']").datetimepicker();
        });
    </script>

    @if(! $errors->isEmpty() && $errors->has($name))
        <small class="form-text text-danger">{{ implode(' ', $errors->get($name)) }}</small>
    @endif

@if($isHorizontal)
</div>
@endif
