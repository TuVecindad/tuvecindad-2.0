@extends('layouts.dashboard')
@section('content')


<div class="uper table-responsive">

    @if(session()->get('success'))
    <div class="alert2 alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif

    @if(auth()->user()->hasRole('superadmin'))

        <table class="table table-striped text-nowrap">
            <thead>
            <tr>
                <td>ID</td>
                <td>Referencia catastral</td>
                <td>Dirección</td>
                <td>Apartamentos</td>
                <td>Creado</td>
                <td>Actualizado</td>
                <td>Piscina</td>
                <td>Gimnasio</td>
                <td>Portero</td>
                <td>Azotea</td>
                <td>Jardin</td>
                <td colspan="4">Acción</td>
            </tr>
            </thead>
            <tbody>


                @foreach($communities as $community)
                <tr>
                    <td>{{$community->id}}</td>
                    <td>{{$community->cad_ref_com}}</td>
                    <td>{{$community->address}}</td>
                    <td>{{$community->apart_num}}</td>
                    <td>{{$community->created_at}}</td>
                    <td>{{$community->updated_at}}</td>
                    <td>{{$community->convert('pool')}}</td>
                    <td>{{$community->convert('gym')}}</td>
                    <td>{{$community->convert('hall')}}</td>
                    <td>{{$community->convert('rooftop')}}</td>
                    <td>{{$community->convert('garden')}}</td>

                    <td><a href="{{ route('communities.edit', $community->id)}}" class="btn btn-primary">Editar</a></td>
                    <td>
                        <button class="btn btn-danger white" type="submit" data-toggle="modal" data-target="#removeModal">Eliminar</button>
                        <form id="remove-form" action="{{ route('communities.destroy', $community->id)}}" method="post" class="mb-0">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>


                    <td><a href="{{ route('communities.adduser', $community->id)}}" class="btn btn-success">Usuario</a></td>
                    <td><a href="{{ route('properties.create', $community->id)}}" class="btn btn-success">Propiedad</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pagination">
            {{ $communities->links() }}
            <a href="{{ route('communities.create')}}" class="btn btn-success mb-1 align-self-start">Añadir comunidad</a>
        </div>
    @else

        @if(Auth::user()->communities->count( )>0)

                <table class="table table-striped text-nowrap">
                    <thead>
                        <tr>
                        <td>ID</td>
                        <td>Referencia catastral</td>
                        <td>Dirección</td>
                        <td>Apartamentos</td>
                        <td>Piscina</td>
                        <td>Gimnasio</td>
                        <td>Portero</td>
                        <td>Azotea</td>
                        <td>Jardin</td>
                        <td colspan="4">Acción</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach(Auth::user()->communities as $community)
                        <tr>
                            <td>{{$community->id}}</td>
                            <td>{{$community->cad_ref_com}}</td>
                            <td>{{$community->address}}</td>
                            <td>{{$community->apart_num}}</td>
                            <td>{{$community->convert('pool')}}</td>
                            <td>{{$community->convert('gym')}}</td>
                            <td>{{$community->convert('hall')}}</td>
                            <td>{{$community->convert('rooftop')}}</td>
                            <td>{{$community->convert('garden')}}</td>

            @if(auth()->user()->hasRoleCommunity($community->id,2))
                            <td><a href="{{ route('communities.edit', $community->id)}}" class="btn btn-primary">Editar</a></td>
                            <td>
                                <button class="btn btn-danger white" type="submit" data-toggle="modal" data-target="#removeModal">Eliminar</button>
                                <form id="remove-form" action="{{ route('communities.destroy', $community->id)}}" method="post" class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                            <td><a href="{{ route('communities.adduser', $community->id)}}" class="btn btn-success">Usuario</a></td>
                            <td><a href="{{ route('properties.create', $community->id)}}" class="btn btn-success">Propiedad</a></td>
            @else
                            <td><a href="#" class="btn btn-primary disabled">Editar</a></td>
                            <td><a href="#" class="btn btn-danger disabled">Eliminar</a></td>
                            <td><a href="#" class="btn btn-success disabled">Usuario</a></td>
                            <td><a href="#" class="btn btn-info disabled">Propiedades</a></td>

            @endif
                        </tr>
            @endforeach

                    </tbody>
                </table>
                @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('communities.create')}}" class="btn btn-success mb-1 align-self-start">Añadir comunidad</a>
                 @endif

        @else
            @if(auth()->user()->hasRole('superadmin') or auth()->user()->hasRole('admin'))
            <div class="card text-center">
                <div class="card-header">

                </div>
                <div class="card-body">
                  <h5 class="card-title">No tienes ninguna comunidad asignada</h5>
                  <p class="card-text"> <span style="color: red">No tienes comunidades, debes crear una</span></p>


                  <a href="{{ route('communities.create')}}" class="btn btn-success mb-1 align-self-start">Añadir comunidad</a>
                </div>
                <div class="card-footer text-muted">

                </div>
              </div>

            @else

            <div class="card text-center">
                <div class="card-header">

                </div>
                <div class="card-body">
                  <h5 class="card-title">No tienes ninguna comunidad asignada</h5>
                  <p class="card-text"><span style="color: red">Contacta con un administrador para unirte a una</span></p>
                  </div>
                <div class="card-footer text-muted">

                </div>
              </div>
            @endif
        @endif
    @endif
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection
