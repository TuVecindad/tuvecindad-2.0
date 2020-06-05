@extends('layouts.dashboard')

@section('content')
@if(session()->get('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div><br />
@endif
<div class="card scroll-card">
    <div class="card-header">
        Actualizar propiedad
    </div>
    <div class="card-body pb-0">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        <form method="post" action="{{ route('property.update', $property->id) }}">
            <div class="form-group">
                @csrf
                @method('PUT')
                <label for="cad_ref_pro">Referencia catastral</label>
                <input type="text" class="form-control" name="cad_ref_pro" value="{{ $property->cad_ref_pro }}" />
            </div>
            <div class="form-group">
                <label for="com_id">Comunidad</label>
                <input type="text" class="form-control" name="com_id" value="{{ $property->com_id }}"/>
            </div>
            <div class="form-group">
                <label for="owner">Propietario</label>
                <input type="text" class="form-control" name="owner" value="{{ $property->owner }}" />
            </div>
            <div class="form-group">
                <label for="tenant">Inquilino</label>
                <input type="text" class="form-control" name="tenant" value="{{ $property->tenant }}"/>
            </div>
            <div class="form-group">
                <label for="house_id">Tipo de propiedad Apartamento</label>
                <select class="form-control" name="house_id">
                    <option value="{{ $property->house_id}}">Si</option>
                    <option value="{{ $property->house_id}}">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="parking_id">Tipo de propiedad Parking</label>
                <select class="form-control" name="parking_id">
                    <option value="{{ $property->parking_id}}">Si</option>
                    <option value="{{ $property->parking_id}}">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="storage_id">Tipo de propiedad Almacen</label>
                <select class="form-control" name="storage_id">
                    <option value="{{ $property->storage_id}}">Si</option>
                    <option value="{{ $property->storage_id}}">No</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar comunidad</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection