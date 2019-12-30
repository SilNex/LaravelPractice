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
        <header class="text-center">
            <h1>
                Logo Here
            </h1>
        </header>

        <b-container fluid class="d-flex min-vh-75">
            <nav class="col-md-3 col-xl-2">
                <ul>
                    <li><a href="#" class="text-decoration-none">Link1</a></li>
                    <li><a href="#" class="text-decoration-none">Link2</a></li>
                    <li><a href="#" class="text-decoration-none">Link3</a></li>
                </ul>
            </nav>
            <div class="col-md-9 col-xl-8 py-md-3 pl-md-5">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum beatae ipsam blanditiis reiciendis repellat consequatur pariatur. Quae fuga ipsa sapiente magni ipsam. Distinctio ab dicta, corrupti odio in eligendi nesciunt.</p>
            </div>
            <aside class="col-md-3 col-xl-2">
                <ul>
                    <li>subLink1</li>
                    <li>subLink2</li>
                    <li>subLink3</li>
                </ul>
            </aside>
        </b-container>

        <footer>
            <h4> Footer </h4>
        </footer>


    </div>
</body>

</html>
