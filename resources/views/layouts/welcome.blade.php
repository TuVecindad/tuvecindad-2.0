<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
        <div class="row page-footer fixed-bottom bg-dark m-0 d-flex">
            @include('includes.footer')
        </div>
    </div>
    @include('includes.logout')
</body>

</html>
