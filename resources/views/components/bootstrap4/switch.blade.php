@if($isHorizontal)
<div class="col-sm-{{ $fieldWidth }}">
@endif

    <div>
        {!! $controlHtml !!}
    </div>

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

    @if(! $errors->isEmpty() && $errors->has($name))
        <small class="form-control-feedback">{{ implode(' ', $errors->get($name)) }}</small>
    @endif

@if($isHorizontal)
</div>
@endif
