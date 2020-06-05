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
                <td colspan="2">Acción</td>
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

                <td><a href="{{ route('communities.edit', $community->id)}}" class="btn btn-primary">Editar</a></td>
                <td>
                    <form action="{{ route('communities.destroy', $community->id)}}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Eliminar</button>
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
                <td><a href="{{ route('communities.edit', $community->id)}}" class="btn btn-primary">Editar</a></td>
                <td>
                    <form action="{{ route('communities.destroy', $community->id)}}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
                @elseif(auth()->user()->hasRole('admin'))
                <td><a href="{{ route('communities.edit', $community->id)}}" class="btn btn-primary" disabled>Editar</a></td>
                <td>
                    <form action="{{ route('communities.destroy', $community->id)}}" method="post" class="mb-0">
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