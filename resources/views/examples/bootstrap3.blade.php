@extends('genealabs-laravel-casts::examples.layout')

@section('head')
    <link href="/css/bootstrap3.css" rel="stylesheet" type="text/css" media="all">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-header">Horizontal Form</h1>
                @form(['url' => 'genealabs/laravel-casts/examples/bootstrap3', 'class' => 'form-horizontal', 'framework' => 'bootstrap3'])
                    @text('text1', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                    @password('password1', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                    @date('date1')
                    @datetime('datetime1')
                    @email('email1', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                    @url('url1', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                    @file('file1', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                    @search ('search1', 'search term', ['placeholder' => 'Placeholder Text', 'label' => 'Search Input'])
                    @number ('number1', 5, ['placeholder' => 'Placeholder Text', 'label' => 'Number Input'])
                    @tel ('tel1', '1234567890', ['placeholder' => 'Placeholder Text', 'label' => 'Tel Input'])
                    @week ('week1', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Week Input'])
                    @month ('month1', 'January', ['placeholder' => 'Placeholder Text', 'label' => 'Month Input'])
                    @textarea('textarea1', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                    @checkbox('checkbox1', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                    @switch('switch1', 'test1', true, ['label' => 'Switch'])
                    @select('select1', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                    @selectMonths('selectMonths1', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Select Months'])
                    @selectWeekdays('selectWeekdays1', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Select Weekdays'])
                    @selectRange('select_range1', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                    @selectRangeWithInterval('select_range_with_interval1', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                    @combobox('combobox1', [1, 2, '3'=>5], [], ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox', 'createFunction' => 'createComboBoxItem'])
                    @signature('signature1')
                    @button('button1', ['class' => 'btn-primary'])
                    @buttonGroup(['label' => 'test label'])
                        @button('button2', ['class' => 'btn-primary'])
                        @button('button3', ['class' => 'btn-primary'])
                        @button('button4', ['class' => 'btn-primary'])
                    @endButtonGroup
                    @staticText('Show me the text!', ['label' => 'What?'])
                    @submit('submit1', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                @endform
            </div>
            <div class="col-sm-6">
                <h1 class="page-header">Normal Form</h1>
                @form(['url' => 'genealabs/laravel-casts/examples/bootstrap3'])
                    @text('text2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                    @password('password2', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                    @date('date2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Date'])
                    @datetime('datetime2', '', ['placeholder' => 'Placeholder Text', 'label' => 'DateTime'])
                    @email('email2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                    @url('url2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                    @file('file2', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                    @search ('search2', 'search term', ['placeholder' => 'Placeholder Text', 'label' => 'Search Input'])
                    @number ('number2', 5, ['placeholder' => 'Placeholder Text', 'label' => 'Number Input'])
                    @tel ('tel2', '1234567890', ['placeholder' => 'Placeholder Text', 'label' => 'Tel Input'])
                    @week ('week2', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Week Input'])
                    @month ('month2', 'January', ['placeholder' => 'Placeholder Text', 'label' => 'Month Input'])
                    @textarea('textarea2', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                    @checkbox('checkbox2', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                    @switch('switch2', 'test', true, ['label' => 'Switch', 'onText' => 'Available', 'offText' => 'Unavailable', 'onColor' => 'success', 'offColor' => 'danger'])
                    @select('select2', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                    @selectMonths('selectMonths2', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Select Months'])
                    @selectWeekdays('selectWeekdays2', 3, ['placeholder' => 'Placeholder Text', 'label' => 'Select Weekdays'])
                    @selectRange('select_range2', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                    @selectRangeWithInterval('select_range_with_interval2', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                    @combobox('combobox2', [1, 2, 3, 4], [], ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                    @signature('signature2')
                    @buttonGroup(['label' => 'test label'])
                        @button('button2', ['class' => 'btn-primary'])
                        @button('button3', ['class' => 'btn-primary'])
                        @button('button4', ['class' => 'btn-primary'])
                    @endButtonGroup
                    @staticText('Show me the text!', ['label' => 'What?'])
                    @submit('submit2', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                @endform
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{!! asset('genealabs-laravel-casts/app.js') !!}"></script>
    <script src="{!! asset('genealabs-laravel-casts/bootstrap3.js') !!}"></script>
@endsection
