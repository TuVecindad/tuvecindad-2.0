<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    @include('includes.logout')
   
    <div class="container-fluid h-auto">
        <div class="row bg-dark align-items-center sticky-top cabecera">
            @yield('cabecera')
            @include('includes.header')
        </div>

        <div class="row">
              @yield('contenido')
        </div>
        
        <div class="row fixed-bottom bg-dark pie">
              @yield('pie')
              @include('includes.footer')
        </div>
    </div>

</body>

</html>