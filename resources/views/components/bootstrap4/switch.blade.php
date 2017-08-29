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
        <div class="invalid-feedback">{{ implode(' ', $errors->get($name)) }}</div>
    @endif

@if($isHorizontal)
</div>
@endif
