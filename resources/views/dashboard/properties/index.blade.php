@extends('layouts.dashboard')
@section('content')
<div class="uper table-responsive">

    <!-- @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif -->
    <table class="table table-striped text-nowrap">
        <thead>
            <tr>
                <td>ID</td>
                <td>Referencia catastral</td>
                <td>Dirección comunidad</td>
                <td>Propietario</td>
                <td>Inquilino</td>
                <td>Apartamento</td>
                <td>Parking</td>
                <td>Almacén</td>
                <td>Creado</td>
                <td>Actualizado</td>
                <td colspan="2">Acción</td>
            </tr>
        </thead>
        <tbody>
            @foreach(/*Auth::user()->*/$property as $property)
            <tr>
                <td>{{$property->id}}</td>
                <td>{{$property->cad_ref_pro}}</td>
                <td>{{$property->com_id}}</td>
                <td>{{$porperty->owner}}</td>
                <td>{{$porperty->tenant}}</td>
                <td>{{$porperty->house_id}}</td>
                <td>{{$porperty->parking_id}}</td>
                <td>{{$porperty->storage_id}}</td>
                <td>{{$property->created_at}}</td>
                <td>{{$property->updated_at}}</td>

        {{--         <td>
                    <select class="mdb-select md-form" searchable=" Comunidad..">
                        @foreach($communities as $comunity)
                        <option value="{{community->id}}"{{$property->com_id}}::{{community->address}}</option>
                        @endforeach
                    </select>
                </td> --}}

                <td><a href="{{ route('property.edit', $property->id)}}" class="btn btn-primary">Editar</a></td>
                <td>
                    <form action="{{ route('property.destroy', $property->id)}}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<div id="pagination" class="d-flex row">
    {{ $property->links() }}
    <a href="{{ route('property.create')}}" class="btn btn-success mb-1 align-self-start">Añadir propiedad</a>
</div>


</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection
