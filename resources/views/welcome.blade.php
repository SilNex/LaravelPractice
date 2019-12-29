<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
</head>

<body>
    <div id='app'>
        <header>
            Logo Here
        </header>

        <b-container fluid class="d-flex">
            <nav class="col-md-3 col-xl-2">
                Link Here
            </nav>
            <div class="col-md-9 col-xl-8 py-md-3 pl-md-5">
                main
            </div>
            <aside class="col-md-3 col-xl-2">
                aside
            </aside>
        </b-container>

        <footer>
            footer
        </footer>


    </div>
</body>

</html>
