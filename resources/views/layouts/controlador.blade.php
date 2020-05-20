<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Tu vecindad</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        @include('includes.head')
    </head>

    <body>
        @include('includes.logout')
        <div class="container-fluid h-auto">
            <div class="row bg-dark align-items-center sticky-top">
                @include('includes.header')
            </div>
            <div class="container">
                @yield('content')
            </div>
            <script src="{{ asset('js/app.js') }}" type="text/js"></script>

            <div class="row fixed-bottom bg-dark">
                @include('includes.footer')
            </div>
        </div>

    </body>

</html>