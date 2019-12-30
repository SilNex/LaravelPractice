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
        <header class="text-center mt-5">
            <h1>
                Logo Here
            </h1>
        </header>

        <b-container class="d-flex min-vh-75">
            <b-row>
                <b-col md="2">
                    <b-list-group>
                        <b-list-group-item v-for="link in [1,2,3,4]">
                            Link @{{ link }}
                        </b-list-group-item>
                    </b-list-group>
                </b-col>
                <b-col md="8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                </b-col>
                <b-col md="2">
                    <b-list-group>
                        <b-list-group-item href="#some-link">Awesome link</b-list-group-item>
                        <b-list-group-item href="#" active>Link with active state</b-list-group-item>
                        <b-list-group-item href="#">Action links are easy</b-list-group-item>
                        <b-list-group-item href="#foobar" disabled>Disabled link</b-list-group-item>
                    </b-list-group>
                <b-col>
            </b-row>
        </b-container>

        <footer>
            <h4> Footer </h4>
        </footer>


    </div>
</body>

</html>
