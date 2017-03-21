@extends('layouts.app')

@section('head')
    <link href="/css/bootstrap4.css" rel="stylesheet" type="text/css" media="all">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-title">Horizontal Form</h1>

                @form(['url' => 'genealabs/laravel-casts/examples/bootstrap4', 'class' => 'form-horizontal', 'framework' => 'bootstrap4'])
                    @text('text1', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                    @password('password1', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                    @email('email1', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                    @url('url1', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                    @file('file1', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                    @textarea('textarea1', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                    @checkbox('checkbox1', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                    @switch('switch1', 'test', true, ['label' => 'Switch'])
                    @date('date1')
                    @datetime('datetime1')
                    @select('select1', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                    @selectRange('select_range1', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                    @selectRangeWithInterval('select_range_with_interval1', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                    @combobox('combobox1', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                    @signature('signature1')
                    @button('button1', ['class' => 'btn-primary'])
                    @buttonGroup(['label' => 'test label'])
                        @button('button2', ['class' => 'btn-primary'])
                        @button('button3', ['class' => 'btn-primary'])
                        @button('button4', ['class' => 'btn-primary'])
                    @endButtonGroup
                    @staticText('Show me the text!', ['label' => 'What?'])
                    @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                @endform
            </div>
            <div class="col-sm-6">
                <h1 class="page-title">Normal Form</h1>
                @form(['url' => 'genealabs/laravel-casts/examples/bootstrap4', 'framework' => 'bootstrap4'])
                    @text('text2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                    @password('password2', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                    @email('email2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                    @url('url2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                    @file('file2', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                    @textarea('textarea2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                    @checkbox('checkbox2', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                    @switch('switch2', 'test', true, ['label' => 'Switch', 'onText' => 'Available', 'offText' => 'Unavailable', 'onColor' => 'success', 'offColor' => 'danger'])
                    @date('date2')
                    @datetime('datetime2')
                    @select('select', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                    @selectRange('selectRange', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                    @selectRangeWithInterval('selectRangeWithInterval', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                    @combobox('combobox', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                    @signature('signature2')
                    @button('button1', ['class' => 'btn-primary'])
                    @buttonGroup(['label' => 'test label'])
                        @button('button2', ['class' => 'btn-primary'])
                        @button('button3', ['class' => 'btn-primary'])
                        @button('button4', ['class' => 'btn-primary'])
                    @endButtonGroup
                    @staticText('Show me the text!', ['label' => 'What?'])
                    @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                @endform
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{!! asset('genealabs-laravel-casts/tether.js') !!}"></script>
    <script src="{!! asset('genealabs-laravel-casts/bootstrap4.js') !!}"></script>
@endsection
