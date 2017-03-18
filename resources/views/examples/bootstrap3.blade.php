@extends('layouts.app')

@section('head')
    <link href="/css/bootstrap3.css" rel="stylesheet" type="text/css" media="all">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-header">Horizontal Form</h1>
                @form(['url' => '', 'class' => 'form-horizontal', 'framework' => 'bootstrap3'])
                    @text('text', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                    @password('password', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                    @date('date')
                    @datetime('datetime')
                    @email('email', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                    @url('url', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                    @file('file', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                    @textarea('textarea', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                    @checkbox('checkbox', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                    @switch('switch1', 'test1', true, ['label' => 'Switch'])
                    @select('select', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                    @selectRange('selectRange', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                    @selectRangeWithInterval('selectRangeWithInterval', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                    @combobox('combobox', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                    @signature('signature1')
                    @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                @endform
            </div>
            <div class="col-sm-6">
                <h1 class="page-header">Normal Form</h1>
                @form(['url' => '', 'framework' => 'bootstrap3'])
                    @text('text', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                    @password('password', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                    @date('date2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Date'])
                    @datetime('datetime2', '', ['placeholder' => 'Placeholder Text', 'label' => 'DateTime'])
                    @email('email', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                    @url('url', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                    @file('file', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                    @textarea('textarea', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                    @checkbox('checkbox', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                    @switch('switch2', 'test', true, ['label' => 'Switch', 'onText' => 'Available', 'offText' => 'Unavailable', 'onColor' => 'success', 'offColor' => 'danger'])
                    @select('select', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                    @selectRange('selectRange', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                    @selectRangeWithInterval('selectRangeWithInterval', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                    @combobox('combobox', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                    @signature('signature2')
                    @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                @endform
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{!! asset('genealabs-laravel-casts/bootstrap3.js') !!}"></script>
@endsection
