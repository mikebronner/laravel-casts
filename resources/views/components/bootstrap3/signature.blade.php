@if($isHorizontal)
<div class="col-sm-offset-{{ $labelWidth }} col-sm-{{ $fieldWidth }}">
@endif

    <div class="signature {{ $name }} well">
        <div class="embed-responsive embed-responsive-16by9">
            <div class="footer">
                <small><em>{{ $options['label'] }}</em></small>

                @if(! $errors->isEmpty() && $errors->has($name))
                    <span class="help-block">{{ implode(' ', $errors->get($name)) }}</span>
                @endif

            </div>
            <canvas class="embed-responsive-item"></canvas>
            <button type="button" class="btn btn-default btn-xs pull-right" onclick="clearSignature('{{ $name }}');">&nbsp;{{ $options['clearButton'] }}&nbsp;</button>
            {!! $controlHtml !!}
        </div>
    </div>
    <script>
        document.onreadystatechange = function () {
           if (document.readyState == "complete") {
                var canvas = document.querySelector('.signature.{{ $name }} canvas');

                if ((window.SignaturePad !== undefined) && (canvas !== null)) {
                    window.signaturePad{{ $name }} = new window.SignaturePad(canvas);

                    var setImageData = function() {
                        var imageData = signaturePad{{ $name }}.toDataURL();
                        var timestamp = '';

                        if (imageData.length > 0) {
                            timestamp = new Date().getTime();
                        }

                        $('input[type=hidden][name={{ $name }}]').val(imageData);
                        $('input[type=hidden][name={{ $name }}_date]').val(timestamp);
                    };

                    var resizeCanvas = function () {
                        var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                        canvas.width = canvas.offsetWidth * ratio;
                        canvas.height = canvas.offsetHeight * ratio;
                        canvas.getContext("2d").scale(ratio, ratio);
                        signaturePad{{ $name }}.clear(); // otherwise isEmpty() might return incorrect value
                    };

                    window.clearSignature = function (name) {
                        window['signaturePad' + name].clear();
                        $('input[type=hidden][name=' + name + ']').val('');
                        $('input[type=hidden][name=' + name + '_date]').val('');
                    };

                    signaturePad{{ $name }}.onEnd = function () {
                        setImageData();
                    };

                    window.addEventListener("resize", resizeCanvas);
                    resizeCanvas();
                }
            }
        }
    </script>

@if($isHorizontal)
</div>
@endif
