@if($isHorizontal)
    <div class="col-sm-{{ $fieldWidth }}">
@endif

    <div class="">
        {!! $controlHtml !!}
    </div>

    @if($name)
    <script defer>
        $("[name='{{ $name }}']").bootstrapSwitch({
            onText: "{{ $options['onText'] ?? 'On' }}",
            offText: "{{ $options['offText'] ?? 'Off' }}",
            onColor: "{{ $options['onColor'] ?? 'info' }}",
            offColor: "{{ $options['offColor'] ?? 'default' }}"
        });
    </script>
    @endif

    @if(! $errors->isEmpty() && $errors->has($name))
        <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
    @endif

@if($isHorizontal)
    </div>
@endif
