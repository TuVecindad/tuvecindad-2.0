@extends('layouts.dashboard')
@section('content')
<div class="uper table-responsive">

    @if(session()->get('success'))
    <div class="alert2 alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
    <table class="table table-striped text-nowrap">
        <thead>
            <tr>
                <td>ID</td>
                <td>Referencia catastral</td>
                <td>Dirección</td>
                <td>Apartamentos</td>
                <td>Creado</td>
                <td>Actualizado</td>
                <td colspan="4">Acción</td>
            </tr>
        </thead>
        <tbody>
            @if(auth()->user()->hasRole('superadmin'))

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

                <td><a href="{{ route('property.create', $community->id)}}" class="btn btn-info mb-1 align-self-start">Propiedades</a></td>
            </tr>
            @endforeach

            @else

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
                
                <td><a href="{{ route('communities.adduser', $community->id)}}" class="btn btn-success">Usuarios</a></td>
                <td><a href="{{ route('property.create', $community->id)}}" class="btn btn-info mb-1 align-self-start">Propiedades</a></td>

                @else
                <td><a href="#" class="btn btn-primary disabled">Editar</a></td>
                <td><a href="#" class="btn btn-danger disabled">Eliminar</a></td>
                <td><a href="#" class="btn btn-success disabled">Usuario</a></td>
                <td><a href="#" class="btn btn-info disabled">Propiedades</a></td>

                @endif
            </tr>
            @endforeach

            @endif
        </tbody>
    </table>

</div>
<div id="pagination" class="d-flex row justify-content-around">
    {{ $communities->links() }}
    @if(auth()->user()->hasRole('superadmin') or auth()->user()->hasRole('admin'))
    <a href="{{ route('communities.create')}}" class="btn btn-success mb-1 align-self-start">Añadir comunidad</a>
    @endif
</div>


</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection
