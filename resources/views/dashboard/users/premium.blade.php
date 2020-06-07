@extends('layouts.dashboard')

@section('content')
<div class="card scroll-card">
    <div class="card-header">
        Actualizar datos
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger mb-0">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @elseif(session()->get('success'))
        <div class="alert alert-success mb-0">
            {{ session()->get('success') }}
        </div><br />
        @elseif(auth()->user()->hasRole('admin'))
            @if($user->hasSubscription())
            <div class="alert alert-info mb-3">
                Estos son tus datos de subscripción
            </div>
            @else
            <div class="alert alert-warning mb-0">
                Te quedan {{auth()->user()->diffDate()}} días de prueba del servicio premium.
            </div><br />
            @endif
        @endif

        <form method="post" action="{{ route('users.updatePremium', $user->id) }}">
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" disabled />
            </div>
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required/>
            </div>
            <div class="form-group">
                <label for="surname1">Primer apellido:</label>
                <input type="text" class="form-control" name="surname1" value="{{ $user->surname1 }}" required/>
            </div>
            <div class="form-group">
                <label for="surname2">Segundo apellido:</label>
                <input type="text" class="form-control" name="surname2" placeholder="No es necesario" value="{{ $user->surname2 }}" />
            </div>
            <div class="form-group">
                <label for="nif">Nif:</label>
                <input type="text" class="form-control" name="nif" value="{{ $user->nif }}" required />
            </div>
            <div class="form-group">
                <label for="phone1">Nº de teléfono:</label>
                <input type="tel" class="form-control" name="phone1" value="{{ $user->phone1 }}" required />
            </div>
            <div class="form-group">
                <label for="phone2">Nº de teléfono alternativo:</label>
                <input type="tel" class="form-control" name="phone2" placeholder="No es necesario" value="{{ $user->phone2 }}" />
            </div>
            <div class="form-group mt-4">
                {!! Form::Label('subscription_type', '¿Qué tipo de subscripción quieres?') !!}
                {{ Form::select('subscription_type', ['anual'=>'Anual (100€/año)', 'trimestral'=>'Trimestral (40€/trimestre)', 'mensual'=>'Mensual (15€/mes)']) }}
            </div>
            <div class="form-group">
                <label for="payment">Datos de pago:</label>
                <input type="text" class="form-control" name="payment" minlength="10" maxlength="20" size="20" required placeholder="Por tu seguridad no mostramos tus datos de pago"/>
            </div>
            <button type="submit" class="btn btn-primary">Actualiza los datos</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection
