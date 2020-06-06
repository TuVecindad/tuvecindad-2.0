<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    <div class="container-fluid h-auto p-0">
        <div class="row bg-dark align-items-center m-0 sticky-top">
            @include('includes.header')
        </div>
        <div>
        @yield('content')
        </div>
        <div class="row bottom bg-dark m-0">
            @include('includes.footer')
        </div>
    </div>
    @include('includes.logout')
</body>

</html>