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
        </div><br/>
        @endif
        <form method="post" action="{{ route('properties.update', $property->id) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="cad_ref_pro">Referencia catastral</label>
                <input type="text" class="form-control" name="cad_ref_pro" value="{{ $property->cad_ref_pro}}" disabled />
            </div>
            <div class="form-group">
                <label for="owner">Mail del propietario</label>
                <input type="email" class="form-control" name="owner" placeholder="No es necesario." value="{{$property->getMail($property->owner)}}" />
            </div>
            <div class="form-group">
                <label for="tenant">Mail del inquilino</label>
                <input type="email" class="form-control" name="tenant" placeholder="No es necesario." value="{{$property->getMail($property->tenant)}}" />
            </div>

            <!-- House Form -->
            @if($property->house_id != null)
            <div class="align-self-center my-3">
                {!! Form::Label('type', 'Tipo de inmueble: ','class="mb-0"') !!}
                {{ Form::select('type', [ 'apartment' => 'Apartamento', 'duplex' => 'Duplex', 'bussiness' => 'Negocio']) }}
            </div>
            <div class="form-group">
                <label for="floor">Piso</label>
                <input type="num" class="form-control" name="floor" value="{{ $property->floor}}" />
            </div>
            <div class="form-group">
                <label for="door">Puerta</label>
                <input type="text" class="form-control" name="door" value="{{ $property->door}}" />
            </div>
            <div class="form-group">
                <label for="sqm">M<sup>2</sup></label>
                <input type="num" class="form-control" name="sqm" value="{{ $property->sqm}}" />
            </div>
            <div class="form-group">
                <label for="room">Habitaciones</label>
                <input type="num" class="form-control" name="room" value="{{ $property->room}}" />
            </div>
            <div class="form-group">
                <label for="bathroom">Baños</label>
                <input type="num" class="form-control" name="bathroom" value="{{ $property->bathroom}}" />
            </div>
            <div class="form-group">
                <label for="occupants">Ocupantes</label>
                <input type="num" class="form-control" name="occupants" value="{{ $property->occupants}}" />
            </div>
            <button type="submit" class="btn btn-primary">Añadir propiedad</button>

            <!-- Parking Form -->
            @elseif($property->parking_id != null)
            <div class="form-group">
                <label for="num_p">Número</label>
                <input type="num" class="form-control" name="num_p" value="{{ $property->getdata('parking','num_p')}}" />
            </div>
            <div class="form-group">
                <label for="sqm_p">M<sup>2</sup></label>
                <input type="num" class="form-control" name="sqm_p" value="{{ $property->getdata('parking','sqm_p')}}" />
            </div>
            <button type="submit" class="btn btn-primary">Añadir propiedad</button>

            <!-- Storage From -->
            @elseif($property->property_id != null)
            <div class="form-group">
                <label for="num_s">Número</label>
                <input type="num" class="form-control" name="num_s" value="{{ $property->getdata('storage','num_s')}}" />
            </div>
            <div class="form-group">
                <label for="sqm_s">M<sup>2</sup></label>
                <input type="num" class="form-control" name="sqm_s" value="{{ $property->getdata('storage','sqm_s')}}" />
            </div>
            <button type="submit" class="btn btn-primary">Añadir propiedad</button>
            @endif
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection