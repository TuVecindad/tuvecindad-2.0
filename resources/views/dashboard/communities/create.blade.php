@extends('layouts.dashboard')

@section('content')
<div class="card uper">
    <div class="card-header">
        Añadir comunidad
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
        <form method="post" action="{{ route('communities.store') }}">
            <div class="form-group">
                @csrf
                <label for="cad_ref_com">Referencia catastral</label>
                <input type="text" class="form-control" name="cad_ref_com" />
            </div>
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" name="address" />
            </div>
            <div class="form-group">
                <label for="apart_num">Numero de apartamentos</label>
                <input type="number" class="form-control" name="apart_num" />
            </div>
            <label>Zonas comunes</label>
            <div class="form-group container">
                <div class="row text-center">
                    <label for="pool" class="col">Piscina</label>
                    <label for="gym" class="col">Gimnasio</label>
                    <label for="hall" class="col">Portero</label>
                    <label for="rooftop" class="col">Azotea</label>
                    <label for="garden" class="col">Jardin</label>
                </div>
                <div class="row">
                    <input type="hidden" value="0" name="com_id" />
                    <input type="hidden" value="0" name="pool" />
                    <input type="hidden" value="0" name="gym" />
                    <input type="hidden" value="0" name="hall" />
                    <input type="hidden" value="0" name="rooftop" />
                    <input type="hidden" value="0" name="garden" />
                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="pool" />
                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="gym" />
                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="hall" />
                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="rooftop"/>
                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="garden"/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Añadir comunidad</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection