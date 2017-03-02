@if($isHorizontal)
    <div class="col-sm-offset-{{ $labelWidth }} col-sm-{{ $fieldWidth }}">
@endif

    <div class="">
        {!! $controlHtml !!}
    </div>
    <script>
        $("[name='{{ $name }}']").bootstrapSwitch({
            onText: "{{ $options['onText'] ?? 'On' }}",
            offText: "{{ $options['offText'] ?? 'Off' }}",
            onColor: "{{ $options['onColor'] ?? 'success' }}",
            offColor: "{{ $options['offColor'] ?? 'danger' }}"
        });
    </script>

    @if(! $errors->isEmpty() && $errors->has($name))
        <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
    @endif

@if($isHorizontal)
    </div>
@endif
