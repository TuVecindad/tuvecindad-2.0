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
                <td colspan="3">Acción</td>
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

                <td>
                    <form action="{{ route('communities.edit', $community->id)}}" method="get" class="mb-0">
                        @csrf
                        <button class="btn btn-primary" type="submit">Editar</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('communities.destroy', $community->id)}}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('communities.addUser', $community->id)}}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-success" type="submit">Agregar</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @else

            @foreach(Auth::user()->communities as $community)
            <tr>
                <td>{{$community->id}}</td>
                <td>{{$community->cad_ref_com}}</td>
                <td>{{$community->address}}</td>
                <td>{{$community->apart_num}}</td>
                <td>{{$community->created_at}}</td>
                <td>{{$community->updated_at}}</td>

                @if(auth()->user()->hasRoleCommunity($community->id,2))
                <td>
                    <form action="{{ route('communities.edit', $community->id)}}" method="get" class="mb-0">
                        @csrf
                        <button class="btn btn-primary" type="submit">Editar</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('communities.destroy', $community->id)}}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('communities.destroy', $community->id)}}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Agregar</button>
                    </form>
                </td>
                @else
                <td>
                    <form action="{{ route('communities.edit', $community->id)}}" method="get" class="mb-0">
                        @csrf
                        <button class="btn btn-primary" type="submit" disabled title='No eres administrador' >Editar</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('communities.destroy', $community->id)}}" method="post" class="mb-0" title='No eres administrador'>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" disabled>Eliminar</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach

            @endif
        </tbody>
    </table>

</div>
<div id="pagination" class="d-flex row justify-content-around">
    {{ $communities->links() }}
    <a href="{{ route('communities.create')}}" class="btn btn-success mb-1 align-self-start">Añadir comunidad</a>
</div>


</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection