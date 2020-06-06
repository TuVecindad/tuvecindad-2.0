@extends('layouts.dashboard')

@section('content')
<div class="card uper">
    <div class="card-header">
        Añadir comunidad
    </div>

    <div class="card-body">
        @if(session()->get('success'))
        <div class="alert2 alert-success mb-0">
            {{ session()->get('success') }}
        </div><br />
        @endif
        @if(session()->get('error'))
        <div class="alert2 alert-danger mb-0">
            <ul class="mb-0">
                <li>
                    {{ session()->get('error') }}
                </li>
            </ul>
        </div><br />
        @endif
        @if ($errors->any())
        <div class="alert alert-danger mb-0">
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
                <input type="text" class="form-control" name="community_show" value="ID: {{ $community->id }} Catastro: {{ $community->cad_ref_com }}" disabled />
                <input type="hidden" class="form-control" name="community_id" value="{{ $community->id }}" />
            </div>
            <div class="form-group">
                <label for="email">Mail de usuario</label>
                <input type="email" class="form-control" name="email" />
            </div>
            <div class="d-flex justify-content-between">
                <div class="align-self-center">
                    {!! Form::Label('role_id', 'Rol del usuario: ','class="mb-0"') !!}
                    {{ Form::select('role_id', [ 4 => 'Inquilino', 3 => 'Dueño', 2 => 'Administrador']) }}
                </div>
                <button type="submit" class="btn btn-primary">Añadir usuario</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection