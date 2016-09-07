<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        select.form-control:not([multiple]) {
            -moz-appearance: none;
            -webkit-appearance: none;
            background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB3aWR0aD0iMTBweCIgaGVpZ2h0PSIxOHB4IiB2aWV3Qm94PSIwIDAgMTAgMTgiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiPiAgICAgICAgPHRpdGxlPlVudGl0bGVkPC90aXRsZT4gICAgPGRlc2M+Q3JlYXRlZCB3aXRoIFNrZXRjaC48L2Rlc2M+ICAgIDxkZWZzPjwvZGVmcz4gICAgPGcgaWQ9IlBhZ2UtMSIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCIgc2tldGNoOnR5cGU9Ik1TUGFnZSI+ICAgICAgICA8ZyBpZD0ic2VsZWN0LWFycm93cyIgc2tldGNoOnR5cGU9Ik1TTGF5ZXJHcm91cCIgZmlsbD0iIzAwMDAwMCI+ICAgICAgICAgICAgPHBhdGggZD0iTTUsMCBMMCw3IEwxMCw3IEw1LDAgTDUsMCBaIE01LDE4IEwxMCwxMSBMMCwxMSBMNSwxOCBMNSwxOCBaIiBpZD0iU2hhcGUiIHNrZXRjaDp0eXBlPSJNU1NoYXBlR3JvdXAiPjwvcGF0aD4gICAgICAgIDwvZz4gICAgPC9nPjwvc3ZnPg==);
            background-size: .5em;
            background-repeat: no-repeat;
            background-position: right .5em center;
            padding-right: 2em;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-inverse">
        <div class="container">
            <a class="navbar-brand" href="#">Laravel Casts Tests</a>
            <ul class="nav navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="/bs3">Boostrap 3</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/bs4">Boostrap 4 <span class="sr-only">(current)</span></a>
              </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-title">Horizontal Form</h1>
                @form(['url' => '', 'class' => 'form-horizontal', 'framework' => 'bootstrap4'])
                    @text('text', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                    @password('password', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                    @email('email', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                    @url('url', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                    @file('file', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                    @textarea('textarea', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                    @checkbox('checkbox', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                    @select('select', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                    @selectRange('selectRange', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                    @selectRangeWithInterval('selectRangeWithInterval', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                    @combobox('combobox', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                    @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                @endform
            </div>
            <div class="col-sm-6">
                <h1 class="page-title">Normal Form</h1>
                @form(['url' => '', 'framework' => 'bootstrap4'])
                    @text('text', '', ['placeholder' => 'Placeholder Text', 'label' => 'Text Input'])
                    @password('password', ['placeholder' => 'Placeholder Text', 'label' => 'Password Input'])
                    @email('email', '', ['placeholder' => 'Placeholder Text', 'label' => 'Email Input'])
                    @url('url', '', ['placeholder' => 'Placeholder Text', 'label' => 'Url Input'])
                    @file('file', ['placeholder' => 'Placeholder Text', 'label' => 'File Input'])
                    @textarea('textarea', '', ['placeholder' => 'Placeholder Text', 'label' => 'Textarea', 'rows' => 7])
                    @checkbox('checkbox', 'test', true, ['placeholder' => 'Placeholder Text', 'label' => 'Checkbox'])
                    @select('select', [1, 2, 3, 4], null, ['placeholder' => 'Placeholder Text', 'label' => 'Select'])
                    @selectRange('selectRange', 1, 21, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range'])
                    @selectRangeWithInterval('selectRangeWithInterval', 1, 21, 3, null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Select Range With Interval'])
                    @combobox('combobox', [1, 2, 3, 4], null, ['class' => 'form-control', 'placeholder' => 'Placeholder Text', 'label' => 'Combobox'])
                    @submit('submit', ['class' => 'btn btn-success', 'label' => 'Submit Button'], '/bs3')
                @endform
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://raw.githubusercontent.com/HubSpot/tether/master/dist/js/tether.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js"></script>
  </body>
</html>
