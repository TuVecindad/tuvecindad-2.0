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
                    <a class="navbar-brand" href="#"><i class="fa fa-bullseye fa-fw"></i> Brand</a>
                    <a href class="navbar-toggler" data-toggle="collapse" data-target=".sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </a>
                    <div class="collapse navbar-collapse sidebar">
                        <ul class="flex-column navbar-nav w-100 justify-content-between">
                            <li class="nav-item">
                                <a class="nav-link pl-0" href="#"><i class="fa fa-heart-o fa-fw"></i> <span class="">Link</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-0 dropdown-toggle text-nowrap" href="#m1" data-parent="#navbar1" data-toggle="collapse" data-target="#m1" aria-expanded="false">
                                    <i class="fa fa-address-card-o fa-fw"></i> <span class=""> Link</span>
                                </a>
                                <div class="collapse" id="m1">
                                    <ul class="flex-column nav">
                                        <a class="nav-link px-0 text-truncate" href="#">Sub</a>
                                        <a class="nav-link px-0 text-truncate" href="#">Sub longer</a>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-0" href="#"><i class="fa fa-book fa-fw"></i> <span class="">Link</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-0" href="#"><i class="fa fa-heart fa-fw"></i> <span class="">Link</span></a>
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