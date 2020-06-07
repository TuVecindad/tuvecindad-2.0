@extends('layouts.dashboard')

@section('content')
<div class="card uper">
    <div class="card-header">
        Añadir propiedades
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        <form method="post" action="{{ route('property.store') }}">
            <div class="form-group">
                @csrf
                <label for="cad_ref_pro">Referencia catastral</label>
                <input type="text" class="form-control" name="cad_ref_pro"/>
            </div>
            <div class="form-group">
                <label for="com_id">Comunidad</label>
                <input type="text" class="form-control" name="com_id" value="{{$com_id ?? ''}}" />
            </div>
            <div class="form-group">
                <label for="owner">Propietario</label>
                <input type="text" class="form-control" name="owner" />
            </div>
            <div class="form-group">
                <label for="tenant">Inquilino</label>
                <input type="text" class="form-control" name="tenant" />
            </div>
            <div class="form-group">
                <label for="house_id">Tipo de propiedad apartamento</label>
                <input type="radio" class="form-control" name="house_id" />
            </div>
            <div class="form-group">
                <label for="parking_id">Tipo de propiedad parking</label>
                <input type="radio" class="form-control" name="parking_id" />
            </div>
            <div class="form-group">
                <label for="storage_id">Tipo de propiedad almacen</label>
                <input type="radio" class="form-control" name="storage_id" />
            </div>
     
            <button type="submit" class="btn btn-primary">Añadir propiedad</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection