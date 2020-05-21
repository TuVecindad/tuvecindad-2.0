<html lang="en">

    <head>
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