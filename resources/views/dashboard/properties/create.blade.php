@extends('layouts.dashboard')

@section('content')
<script>
    function house_d() {
        document.getElementById("house_d").classList.add("show");
        document.getElementById("parking_d").classList.remove("show");
        document.getElementById("storage_d").classList.remove("show");
    };

    function parking_d() {
        document.getElementById("house_d").classList.remove("show");
        document.getElementById("parking_d").classList.add("show");
        document.getElementById("storage_d").classList.remove("show");
    };

    function storage_d() {
        document.getElementById("parking_d").classList.remove("show");
        document.getElementById("house_d").classList.remove("show");
        document.getElementById("storage_d").classList.add("show");
    }
</script>
<div class="card uper" style="margin-bottom: 4%;">
    <div class="card-header">
        Añadir propiedad
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
        <form method="post" action="{{ route('properties.store')}}">
            <input type="hidden" class="form-control" name="com_id" value="{{ $community->id }}" />
            <div class="form-group">
                @csrf
                <label for="cad_ref_pro">Referencia catastral</label>
                <input type="text" class="form-control" name="cad_ref_pro" />
            </div>
            <div class="form-group">
                <label for="owner">Mail del propietario</label>
                <input type="email" class="form-control" name="owner" placeholder="No es necesario." />
            </div>
            <div class="form-group">
                <label for="tenant">Mail del inquilino</label>
                <input type="email" class="form-control" name="tenant" placeholder="No es necesario." />
            </div>
            <label>Tipo de propiedad</label>
            <div class="form-group container">
                <div class="row text-center">
                    <label for="house" class="col">Inmueble</label>
                    <label for="parking" class="col">Parking</label>
                    <label for="storage" class="col">Trastero</label>
                </div>
                <div class="row">
                    <input id="house" style="width: 30px;" type="radio" value="house" class="form-control m-0 col" name="type_form" onclick="house_d()" />
                    <input id="parking" style="width: 30px;" type="radio" value="parking" class="form-control m-0 col" name="type_form" onclick="parking_d()" />
                    <input id="storage" style="width: 30px;" type="radio" value="storage" class="form-control m-0 col" name="type_form" onclick="storage_d()" />
                </div>
            </div>

            <!-- House Form -->
            <div class="collapse house" id="house_d">
                <div class="align-self-center my-3">
                    {!! Form::Label('type', 'Tipo de inmueble: ','class="mb-0"') !!}
                    {{ Form::select('type', [ 'apartment' => 'Apartamento', 'duplex' => 'Duplex', 'bussiness' => 'Negocio']) }}
                </div>
                <div class="form-group">
                    <label for="floor">Piso</label>
                    <input type="num" class="form-control" name="floor" />
                </div>
                <div class="form-group">
                    <label for="door">Puerta</label>
                    <input type="text" class="form-control" name="door" />
                </div>
                <div class="form-group">
                    <label for="sqm">M<sup>2</sup></label>
                    <input type="num" class="form-control" name="sqm" />
                </div>
                <div class="form-group">
                    <label for="room">Habitaciones</label>
                    <input type="num" class="form-control" name="room" />
                </div>
                <div class="form-group">
                    <label for="bathroom">Baños</label>
                    <input type="num" class="form-control" name="bathroom" />
                </div>
                <div class="form-group">
                    <label for="occupants">Ocupantes</label>
                    <input type="num" class="form-control" name="occupants" />
                </div>
                <button type="submit" class="btn btn-primary">Añadir propiedad</button>
            </div>

            <!-- Parking Form -->
            <div class="collapse parking" id="parking_d">
                <div class="form-group">
                    <label for="num_p">Número</label>
                    <input type="num" class="form-control" name="num_p" />
                </div>
                <div class="form-group">
                    <label for="sqm_p">M<sup>2</sup></label>
                    <input type="num" class="form-control" name="sqm_p" />
                </div>
                <button type="submit" class="btn btn-primary">Añadir propiedad</button>
            </div>

            <!-- Storage From -->
            <div class="collapse storage" id="storage_d">
                <div class="form-group">
                    <label for="num_s">Número</label>
                    <input type="num" class="form-control" name="num_s" />
                </div>
                <div class="form-group">
                    <label for="sqm_s">M<sup>2</sup></label>
                    <input type="num" class="form-control" name="sqm_s" />
                </div>
                <button type="submit" class="btn btn-primary">Añadir propiedad</button>
            </div>

        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection