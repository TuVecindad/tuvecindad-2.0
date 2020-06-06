@extends('layouts.dashboard')

@section('content')
@if(session()->get('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div><br />
@endif
<div class="card scroll-card">
    <div class="card-header">
        Update community
    </div>
    <div class="card-body pb-0">
        @if ($errors->any())
        <div class="alert alert-danger mb-0">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        <form method="post" action="{{ route('communities.update', $community->id) }}">
            <div class="form-group">
                @csrf
                @method('PUT')
                <label for="cad_ref_com">Referencia catastral</label>
                <input type="text" class="form-control" name="cad_ref_com" value="{{ $community->cad_ref_com }}" />
            </div>
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" name="address" value="{{ $community->address }}" />
            </div>
            <div class="form-group">
                <label for="apart_num">Numero de apartamentos</label>
                <input type="number" class="form-control" name="apart_num" value="{{ $community->apart_num }}" />
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
                    <input type="hidden" value="0" name="pool" />
                    <input type="hidden" value="0" name="gym" />
                    <input type="hidden" value="0" name="hall" />
                    <input type="hidden" value="0" name="rooftop" />
                    <input type="hidden" value="0" name="garden" />

                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="pool" {{ $community->prueba('pool') }}/>
                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="gym" {{ $community->prueba('gym') }}/>
                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="hall" {{ $community->prueba('hall') }}/>
                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="rooftop" {{ $community->prueba('rooftop') }}/>
                    <input style="width: 30px;" type="checkbox" value="1" class="form-control m-0 col" name="garden" {{ $community->prueba('garden') }}/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update community</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection