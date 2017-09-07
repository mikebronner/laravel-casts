@if($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

<div>
    {!! $controlHtml !!}
</div>


@if(! $errors->isEmpty() && $errors->has($name))
    <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
@endif

@if($isHorizontal)
    </div>
@endif

@section ('genealabs-laravel-casts')
    @parent

    <script>
        window['genealabsLaravelCasts'] = window.genealabsLaravelCasts || {};
        window.genealabsLaravelCasts['switchLoaders'] = window.genealabsLaravelCasts.switchLoaders || [];
        window.genealabsLaravelCasts.switchLoaders.push(function () {
            $("[name='{{ $name }}']").bootstrapSwitch({
                onText: "{{ $options['onText'] ?? 'On' }}",
                offText: "{{ $options['offText'] ?? 'Off' }}",
                onColor: "{{ $options['onColor'] ?? 'info' }}",
                offColor: "{{ $options['offColor'] ?? 'default' }}"
            });
        });
    </script>
@endsection
