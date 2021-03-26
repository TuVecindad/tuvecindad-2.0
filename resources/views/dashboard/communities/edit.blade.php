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
        <div class="alert alert-danger">
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
            <button type="submit" class="btn btn-primary">Update community</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection