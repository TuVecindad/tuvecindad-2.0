@extends('layouts.dashboard')

@section('content')
<div class="card uper">
    <div class="card-header">
        Añadir comunidad
    </div>
    @if(session()->get('success'))
    <div class="alert2 alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
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
        <form method="post" action="{{ route('communities.storeuser') }}">
            <div class="form-group">
                @csrf
                <label for="community_id">Comunidad</label>
                <input type="text" class="form-control" name="community_show" value="ID: {{ $community->id }} Catastro: {{ $community->cad_ref_com }}" disabled/>
                <input type="hidden" class="form-control" name="community_id" value="{{ $community->id }}"/>
            </div>
            <div class="form-group">
                <label for="email">Mail de usuario</label>
                <input type="email" class="form-control" name="email" />
            </div>
            <div class="form-group">
                <label for="role_id">Rol</label>
                <input type="text" class="form-control" name="role_id" />
            </div>
            <button type="submit" class="btn btn-primary">Añadir usuario</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection