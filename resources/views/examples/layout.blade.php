<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

        @yield ('css')

    </head>

    <body>
        <div id="app">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Casts for Laravel</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link" href="{{ url('/genealabs/laravel-casts/examples/bootstrap3') }}">Bootstrap 3</a></li>
                        <li><a class="nav-link" href="{{ url('/genealabs/laravel-casts/examples/bootstrap4') }}">Bootstrap 4</a></li>
                        <li><a class="nav-link" href="{{ url('/genealabs/laravel-casts/examples/tailwind') }}">TailwindCSS</a></li>
                    </ul>
                </div>
            </nav>

            @yield('content')

        </div>

        <script src="{{ asset('js/app.js') }}"></script>

        @yield ('js')
        @yield ('genealabs-laravel-casts')

    </body>
</html>
