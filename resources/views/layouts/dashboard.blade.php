<html lang="en">

<head>
    @include('includes.head')
</head>

<body class="overflow-hidden">
    <div class="container-fluid p-0">
        <div class="row bg-dark align-items-center m-0">
            @include('includes.header')
        </div>
        <div class="row wrapper flex-column flex-sm-row m-0">
            <div class="col-sm-1 p-0 bg-dark flex-shrink-1 sticky-top" id="Navbar">
                <nav class="navbar navbar-expand-sm navbar-dark bg-dark align-items-start flex-sm-column flex-row">
                    <a class="navbar-brand" href="#"><i class="fa fa-bullseye fa-fw"></i> Menú</a>
                    <a href class="navbar-toggler" data-toggle="collapse" data-target=".sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </a>
                    <div class="collapse navbar-collapse sidebar">
                        <ul class="flex-column navbar-nav w-100 justify-content-between">
                            <!-- Usuario -->
                            <li class="nav-item">
                                <a class="nav-link pl-0" href="{{ route('users.edit', Auth::id()) }}"><i class="fa fa-heart-o fa-fw"></i> <span class="">Usuario</span></a>
                            </li>
                            <!-- Comunidad -->
                            <li class="nav-item">
                                <a class="nav-link pl-0 dropdown-toggle text-nowrap"data-toggle="collapse" data-target=".community">
                                    <i class="fa fa-address-card-o fa-fw"></i> <span class=""> Comunidad</span>
                                </a>
                                <div class="collapse community" id="m1">
                                    <ul class="flex-column nav">
                                        <a class="nav-link px-0 text-truncate" href="{{ route('communities.index') }}">Mostrar</a>
                                        <a class="nav-link px-0 text-truncate" href="{{ route('communities.create') }}">Crear</a>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div id="scroll" class="col bg-faded py-3 overflow-auto vh-100">
                @yield('content')
            </div>
        </div>

    </div>
    @include('includes.logout')
</body>

</html>